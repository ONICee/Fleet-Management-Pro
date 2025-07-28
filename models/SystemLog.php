<?php
require_once __DIR__ . '/BaseModel.php';

class SystemLog extends BaseModel {
    protected $table = 'system_logs';
    protected $fillable = [
        'user_id', 'action', 'entity_type', 'entity_id', 'old_values', 
        'new_values', 'ip_address', 'user_agent'
    ];
    
    public function logActivity($userId, $action, $entityType, $entityId = null, $oldValues = null, $newValues = null) {
        $data = [
            'user_id' => $userId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ];
        
        return $this->create($data);
    }
    
    public function getRecentActivity($limit = 50) {
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                ORDER BY sl.created_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
    
    public function getUserActivity($userId, $limit = 50) {
        $sql = "SELECT * FROM system_logs
                WHERE user_id = ?
                ORDER BY created_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll();
    }
    
    public function getEntityActivity($entityType, $entityId, $limit = 50) {
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                WHERE sl.entity_type = ? AND sl.entity_id = ?
                ORDER BY sl.created_at DESC
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$entityType, $entityId, $limit]);
        return $stmt->fetchAll();
    }
    
    public function getActivityByDateRange($startDate, $endDate) {
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                WHERE DATE(sl.created_at) BETWEEN ? AND ?
                ORDER BY sl.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll();
    }
    
    public function getActivityStats($days = 30) {
        $stats = [];
        
        // Activity count by action in last N days
        $sql = "SELECT action, COUNT(*) as count
                FROM system_logs
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
                GROUP BY action
                ORDER BY count DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$days]);
        $stats['by_action'] = $stmt->fetchAll();
        
        // Activity count by entity type in last N days
        $sql = "SELECT entity_type, COUNT(*) as count
                FROM system_logs
                WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
                GROUP BY entity_type
                ORDER BY count DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$days]);
        $stats['by_entity_type'] = $stmt->fetchAll();
        
        // Activity count by user in last N days
        $sql = "SELECT u.username, u.first_name, u.last_name, COUNT(*) as count
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                WHERE sl.created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
                GROUP BY sl.user_id
                ORDER BY count DESC
                LIMIT 10";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$days]);
        $stats['by_user'] = $stmt->fetchAll();
        
        return $stats;
    }
    
    public function searchLogs($searchTerm, $startDate = null, $endDate = null) {
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id
                WHERE (sl.action LIKE ? OR sl.entity_type LIKE ? OR u.username LIKE ?)";
        
        $params = ["%{$searchTerm}%", "%{$searchTerm}%", "%{$searchTerm}%"];
        
        if ($startDate) {
            $sql .= " AND DATE(sl.created_at) >= ?";
            $params[] = $startDate;
        }
        
        if ($endDate) {
            $sql .= " AND DATE(sl.created_at) <= ?";
            $params[] = $endDate;
        }
        
        $sql .= " ORDER BY sl.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function getLogsWithPagination($page = 1, $perPage = 50, $filters = []) {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT sl.*, u.username, u.first_name, u.last_name
                FROM system_logs sl
                LEFT JOIN users u ON sl.user_id = u.id";
        
        $countSql = "SELECT COUNT(*) as total
                     FROM system_logs sl
                     LEFT JOIN users u ON sl.user_id = u.id";
        
        $whereClause = [];
        $params = [];
        
        if (!empty($filters['user_id'])) {
            $whereClause[] = "sl.user_id = ?";
            $params[] = $filters['user_id'];
        }
        
        if (!empty($filters['action'])) {
            $whereClause[] = "sl.action = ?";
            $params[] = $filters['action'];
        }
        
        if (!empty($filters['entity_type'])) {
            $whereClause[] = "sl.entity_type = ?";
            $params[] = $filters['entity_type'];
        }
        
        if (!empty($filters['start_date'])) {
            $whereClause[] = "DATE(sl.created_at) >= ?";
            $params[] = $filters['start_date'];
        }
        
        if (!empty($filters['end_date'])) {
            $whereClause[] = "DATE(sl.created_at) <= ?";
            $params[] = $filters['end_date'];
        }
        
        if (!empty($filters['search'])) {
            $whereClause[] = "(sl.action LIKE ? OR sl.entity_type LIKE ? OR u.username LIKE ?)";
            $searchParam = "%{$filters['search']}%";
            $params = array_merge($params, [$searchParam, $searchParam, $searchParam]);
        }
        
        if (!empty($whereClause)) {
            $whereStr = " WHERE " . implode(' AND ', $whereClause);
            $sql .= $whereStr;
            $countSql .= $whereStr;
        }
        
        // Count total records
        $stmt = $this->db->prepare($countSql);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        
        // Get paginated results
        $sql .= " ORDER BY sl.created_at DESC LIMIT {$offset}, {$perPage}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll();
        
        return [
            'data' => $results,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total_records' => $total,
                'total_pages' => ceil($total / $perPage),
                'has_previous' => $page > 1,
                'has_next' => $page < ceil($total / $perPage)
            ]
        ];
    }
}
?>