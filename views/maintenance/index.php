<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-wrench me-2"></i>
                    Maintenance Management
                </h1>
                <?php if (in_array($userRole, ['super_admin', 'admin', 'data_entry_officer'])): ?>
                    <a href="<?= url('/maintenance/schedule') ?>" class="btn btn-warning">
                        <i class="fas fa-plus me-2"></i>
                        Schedule Maintenance
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-calendar-check fa-2x text-warning mb-2"></i>
                        <h5 class="text-warning">Total</h5>
                        <h3 class="text-light"><?= $stats['total'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-clock fa-2x text-info mb-2"></i>
                        <h5 class="text-info">Upcoming</h5>
                        <h3 class="text-light"><?= $stats['upcoming'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-danger h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                        <h5 class="text-danger">Overdue</h5>
                        <h3 class="text-light"><?= $stats['overdue'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-success h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-cogs fa-2x text-success mb-2"></i>
                        <h5 class="text-success">In Progress</h5>
                        <h3 class="text-light"><?= $stats['in_progress'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-primary h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle fa-2x text-primary mb-2"></i>
                        <h5 class="text-primary">Completed</h5>
                        <h3 class="text-light"><?= $stats['completed_month'] ?? 0 ?></h3>
                        <small class="text-muted">This Month</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 mb-3">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-naira-sign fa-2x text-secondary mb-2"></i>
                        <h5 class="text-secondary">Monthly Cost</h5>
                        <h3 class="text-light">₦<?= number_format($stats['monthly_cost'] ?? 0) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Overdue Maintenance -->
        <?php if (!empty($overdueMaintenance)): ?>
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Overdue Maintenance (<?= count($overdueMaintenance) ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Type</th>
                                    <th>Due Date</th>
                                    <th>Days Overdue</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($overdueMaintenance, 0, 5) as $maintenance): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($maintenance['vehicle_brand'] . ' ' . $maintenance['vehicle_model']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($maintenance['serial_number']) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $maintenance['maintenance_category'] === 'overhaul' ? 'warning text-dark' : ($maintenance['maintenance_category'] === 'scheduled' ? 'info' : 'secondary') ?>">
                                            <?= ucfirst($maintenance['maintenance_category']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('M j, Y', strtotime($maintenance['scheduled_date'])) ?></td>
                                    <td><span class="badge bg-danger"><?= $maintenance['days_overdue'] ?> days</span></td>
                                    <td>
                                        <a href="<?= url('/maintenance/complete/' . $maintenance['id']) ?>" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Upcoming Maintenance -->
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark border-info">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Upcoming Maintenance
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($upcomingMaintenance)): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No upcoming maintenance scheduled</p>
                            <a href="<?= url('/maintenance/schedule') ?>" class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>Schedule Maintenance
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Vehicle</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Priority</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($upcomingMaintenance, 0, 8) as $maintenance): ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($maintenance['vehicle_brand'] . ' ' . $maintenance['vehicle_model']) ?></strong><br>
                                            <small class="text-muted"><?= htmlspecialchars($maintenance['serial_number']) ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $maintenance['maintenance_category'] === 'overhaul' ? 'warning text-dark' : ($maintenance['maintenance_category'] === 'scheduled' ? 'info' : 'secondary') ?>">
                                                <?= ucfirst($maintenance['maintenance_category']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('M j, Y', strtotime($maintenance['scheduled_date'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $maintenance['priority'] === 'critical' ? 'danger' : ($maintenance['priority'] === 'high' ? 'warning text-dark' : ($maintenance['priority'] === 'normal' ? 'info' : 'secondary')) ?>">
                                                <?= ucfirst($maintenance['priority']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= url('/maintenance/complete/' . $maintenance['id']) ?>" 
                                               class="btn btn-outline-success btn-sm" title="Complete">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if (count($upcomingMaintenance) > 8): ?>
                            <div class="text-center mt-3">
                                <small class="text-muted">Showing 8 of <?= count($upcomingMaintenance) ?> upcoming maintenance items</small>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Maintenance History -->
    <?php if (!empty($recentHistory)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Recent Maintenance History
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Vehicle</th>
                                    <th>Category</th>
                                    <th>Work Performed</th>
                                    <th>Cost</th>
                                    <th>Service Provider</th>
                                    <th>Performed By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentHistory as $history): ?>
                                <tr>
                                    <td><?= date('M j, Y', strtotime($history['maintenance_date'])) ?></td>
                                    <td>
                                        <strong><?= htmlspecialchars($history['vehicle_brand'] . ' ' . $history['vehicle_model']) ?></strong><br>
                                        <small class="text-muted"><?= htmlspecialchars($history['serial_number']) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $history['maintenance_category'] === 'scheduled' ? 'success' : ($history['maintenance_category'] === 'overhaul' ? 'warning text-dark' : 'danger') ?>">
                                            <?= ucfirst($history['maintenance_category']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($history['work_performed']) ?></td>
                                    <td><?= $history['cost'] ? '₦' . number_format($history['cost'], 2) : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($history['service_provider'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($history['created_by_name'] ?? 'N/A') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>