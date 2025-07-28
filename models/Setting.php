<?php
// New model: Setting.php – simple key-value store for application configuration.
class Setting {
    private $db;
    private $table = 'settings';
    private $tableChecked = false;

    public function __construct($db) {
        $this->db = $db;
        $this->ensureTableExists();
    }

    private function ensureTableExists() {
        if ($this->tableChecked) return;
        try {
            $this->db->query("SELECT 1 FROM {$this->table} LIMIT 1");
        } catch (PDOException $e) {
            // 42S02: base table not found
            if ($e->getCode() === '42S02') {
                $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (\n                    `key` varchar(100) NOT NULL PRIMARY KEY,\n                    `value` text NULL,\n                    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
                $this->db->exec($sql);
            } else {
                throw $e;
            }
        }
        $this->tableChecked = true;
    }

    /**
     * Retrieve a setting value or return the provided default if key is absent.
     */
    public function get($key, $default = null) {
        $stmt = $this->db->prepare("SELECT `value` FROM {$this->table} WHERE `key` = ? LIMIT 1");
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }

    /**
     * Persist a setting value; inserts or updates as needed.
     */
    public function set($key, $value) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)");
        return $stmt->execute([$key, $value]);
    }
}
?>