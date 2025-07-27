<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-history me-2"></i>
                    System Logs
                </h1>
            </div>
        </div>
    </div>

    <!-- Activity Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body text-center">
                    <div class="text-info">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <h5>Total Activities</h5>
                        <h3 class="text-light"><?= $stats['total'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-success h-100">
                <div class="card-body text-center">
                    <div class="text-success">
                        <i class="fas fa-sign-in-alt fa-2x mb-2"></i>
                        <h5>Logins Today</h5>
                        <h3 class="text-light"><?= $stats['logins_today'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body text-center">
                    <div class="text-warning">
                        <i class="fas fa-edit fa-2x mb-2"></i>
                        <h5>Changes Today</h5>
                        <h3 class="text-light"><?= $stats['changes_today'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-danger h-100">
                <div class="card-body text-center">
                    <div class="text-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <h5>Errors Today</h5>
                        <h3 class="text-light"><?= $stats['errors_today'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Logs Table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Recent System Activity
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($logs)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-history fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Activity Logs</h4>
                            <p class="text-muted">System activity will appear here once users start using the application.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-clock me-1"></i>Timestamp</th>
                                        <th><i class="fas fa-user me-1"></i>User</th>
                                        <th><i class="fas fa-bolt me-1"></i>Action</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Entity</th>
                                        <th><i class="fas fa-hashtag me-1"></i>Entity ID</th>
                                        <th><i class="fas fa-network-wired me-1"></i>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <td>
                                                <small class="text-muted"><?= date('M j, Y g:i:s A', strtotime($log['created_at'])) ?></small>
                                            </td>
                                            <td>
                                                <?php if ($log['username']): ?>
                                                    <span class="text-info"><?= htmlspecialchars($log['first_name'] . ' ' . $log['last_name']) ?></span><br>
                                                    <small class="text-muted">@<?= htmlspecialchars($log['username']) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">System</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $actionClass = match($log['action']) {
                                                    'login' => 'bg-success',
                                                    'logout' => 'bg-secondary',
                                                    'create' => 'bg-primary',
                                                    'update' => 'bg-warning text-dark',
                                                    'delete' => 'bg-danger',
                                                    'view' => 'bg-info',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $actionClass ?>">
                                                    <?= ucfirst(htmlspecialchars($log['action'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-light"><?= ucfirst(str_replace('_', ' ', htmlspecialchars($log['entity_type']))) ?></span>
                                            </td>
                                            <td>
                                                <?php if ($log['entity_id']): ?>
                                                    <span class="text-warning">#<?= $log['entity_id'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted font-monospace"><?= htmlspecialchars($log['ip_address'] ?? 'N/A') ?></small>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>