<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-gas-pump me-2"></i>
                    Fuel Records
                </h1>
                <a href="<?= url('/fuel/record') ?>" class="btn btn-warning">
                    <i class="fas fa-plus me-2"></i>
                    Record Fuel
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body text-center">
                    <div class="text-info">
                        <i class="fas fa-list fa-2x mb-2"></i>
                        <h5>Total Records</h5>
                        <h3 class="text-light"><?= $stats['total_records'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body text-center">
                    <div class="text-warning">
                        <i class="fas fa-naira-sign fa-2x mb-2"></i>
                        <h5>Monthly Cost</h5>
                        <h3 class="text-light">₦<?= number_format($stats['monthly_cost'] ?? 0, 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-success h-100">
                <div class="card-body text-center">
                    <div class="text-success">
                        <i class="fas fa-tint fa-2x mb-2"></i>
                        <h5>Monthly Quantity</h5>
                        <h3 class="text-light"><?= number_format($stats['monthly_quantity'] ?? 0, 2) ?>L</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-danger h-100">
                <div class="card-body text-center">
                    <div class="text-danger">
                        <i class="fas fa-calculator fa-2x mb-2"></i>
                        <h5>Avg Price/L</h5>
                        <h3 class="text-light">₦<?= number_format($stats['avg_price'] ?? 0, 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuel Records Table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Fuel Consumption Records
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($fuelRecords)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-gas-pump fa-3x text-warning mb-3"></i>
                            <h4 class="text-light">No Fuel Records Found</h4>
                            <p class="text-muted">Start by recording your first fuel transaction.</p>
                            <a href="<?= url('/fuel/record') ?>" class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>
                                Record First Fuel Entry
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-calendar me-1"></i>Date</th>
                                        <th><i class="fas fa-car me-1"></i>Vehicle</th>
                                        <th><i class="fas fa-user me-1"></i>Driver</th>
                                        <th><i class="fas fa-gas-pump me-1"></i>Station</th>
                                        <th><i class="fas fa-flask me-1"></i>Type</th>
                                        <th><i class="fas fa-tint me-1"></i>Quantity</th>
                                        <th><i class="fas fa-naira-sign me-1"></i>Cost</th>
                                        <th><i class="fas fa-receipt me-1"></i>Receipt</th>
                                        <th><i class="fas fa-map-marker-alt me-1"></i>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fuelRecords as $record): ?>
                                        <tr>
                                            <td>
                                                <span class="text-light"><?= date('M j, Y', strtotime($record['fuel_date'])) ?></span><br>
                                                <small class="text-muted"><?= date('g:i A', strtotime($record['created_at'])) ?></small>
                                            </td>
                                            <td>
                                                <strong class="text-warning"><?= htmlspecialchars($record['vehicle_brand'] ?? 'N/A') ?></strong><br>
                                                <small class="text-muted"><?= htmlspecialchars($record['vehicle_model'] ?? '') ?></small><br>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($record['serial_number'] ?? 'N/A') ?></span>
                                            </td>
                                            <td>
                                                <?php if ($record['driver_name']): ?>
                                                    <span class="text-info"><?= htmlspecialchars($record['driver_name']) ?></span><br>
                                                    <small class="text-muted">@<?= htmlspecialchars($record['driver_username']) ?></small>
                                                <?php else: ?>
                                                    <span class="text-muted">Not Assigned</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-light"><?= htmlspecialchars($record['fuel_station']) ?></span>
                                            </td>
                                            <td>
                                                <?php 
                                                $fuelClass = match($record['fuel_type']) {
                                                    'gasoline' => 'bg-info',
                                                    'diesel' => 'bg-warning text-dark',
                                                    'electric' => 'bg-success',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $fuelClass ?>">
                                                    <?= ucfirst($record['fuel_type']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <strong class="text-success"><?= number_format($record['quantity'], 2) ?> L</strong><br>
                                                <small class="text-muted">₦<?= number_format($record['price_per_unit'], 2) ?>/L</small>
                                            </td>
                                            <td>
                                                <strong class="text-warning">₦<?= number_format($record['total_cost'], 2) ?></strong>
                                            </td>
                                            <td>
                                                <?php if ($record['receipt_number']): ?>
                                                    <span class="text-info"><?= htmlspecialchars($record['receipt_number']) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-light"><?= htmlspecialchars($record['location'] ?? 'N/A') ?></span>
                                                <?php if ($record['mileage_at_fillup']): ?>
                                                    <br><small class="text-muted"><?= number_format($record['mileage_at_fillup']) ?> km</small>
                                                <?php endif; ?>
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