<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-chart-bar me-2"></i>
                    Reports & Analytics
                </h1>
            </div>
        </div>
    </div>

    <!-- Fleet Overview Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body text-center">
                    <div class="text-warning">
                        <i class="fas fa-car fa-2x mb-2"></i>
                        <h5>Total Fleet</h5>
                        <h3 class="text-light"><?= $fleetStats['total'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-success h-100">
                <div class="card-body text-center">
                    <div class="text-success">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <h5>Serviceable</h5>
                        <h3 class="text-light"><?= $fleetStats['serviceable'] ?? 0 ?></h3>
                        <small class="text-muted"><?= $fleetStats['total'] > 0 ? round(($fleetStats['serviceable']/$fleetStats['total'])*100, 1) : 0 ?>%</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body text-center">
                    <div class="text-info">
                        <i class="fas fa-naira-sign fa-2x mb-2"></i>
                        <h5>Monthly Fuel Cost</h5>
                        <h3 class="text-light">₦<?= number_format($fuelStats['monthly_cost'] ?? 0, 0) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-danger h-100">
                <div class="card-body text-center">
                    <div class="text-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <h5>Unserviceable</h5>
                        <h3 class="text-light"><?= $fleetStats['unserviceable'] ?? 0 ?></h3>
                        <small class="text-muted"><?= $fleetStats['total'] > 0 ? round(($fleetStats['unserviceable']/$fleetStats['total'])*100, 1) : 0 ?>%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Fleet Distribution by Agency -->
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark border-info">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        Fleet Distribution by Agency
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($vehiclesByAgency)): ?>
                        <?php foreach ($vehiclesByAgency as $agency): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="text-warning mb-1"><?= htmlspecialchars($agency['agency_name']) ?></h6>
                                    <small class="text-muted"><?= htmlspecialchars($agency['agency_code']) ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary fs-6"><?= $agency['vehicle_count'] ?? 0 ?> vehicles</span>
                                    <div class="progress mt-1" style="width: 100px; height: 6px;">
                                        <div class="progress-bar bg-warning" 
                                             style="width: <?= $fleetStats['total'] > 0 ? (($agency['vehicle_count']/$fleetStats['total'])*100) : 0 ?>%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center">No vehicle distribution data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Fuel Consumption -->
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark border-success">
                <div class="card-header bg-success text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-gas-pump me-2"></i>
                        Recent Fuel Activity
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentFuelRecords)): ?>
                        <?php foreach (array_slice($recentFuelRecords, 0, 5) as $record): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary">
                                <div>
                                    <h6 class="text-warning mb-1"><?= htmlspecialchars($record['vehicle_brand']) ?> <?= htmlspecialchars($record['vehicle_model']) ?></h6>
                                    <small class="text-muted">
                                        <?= date('M j, Y', strtotime($record['fuel_date'])) ?> • 
                                        <?= number_format($record['quantity'], 1) ?>L <?= ucfirst($record['fuel_type']) ?>
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="text-success fw-bold">₦<?= number_format($record['total_cost'], 0) ?></span><br>
                                    <small class="text-muted"><?= htmlspecialchars($record['fuel_station']) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="text-center mt-3">
                            <a href="<?= url('/fuel') ?>" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                View All Records
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center">No recent fuel records available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Fuel Consumption Analysis -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Fuel Consumption Analysis
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="border-end border-secondary pe-3">
                                <h4 class="text-info"><?= number_format($fuelStats['total_records'] ?? 0) ?></h4>
                                <small class="text-muted">Total Fuel Records</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="border-end border-secondary pe-3">
                                <h4 class="text-success"><?= number_format($fuelStats['monthly_quantity'] ?? 0, 0) ?>L</h4>
                                <small class="text-muted">Monthly Consumption</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="border-end border-secondary pe-3">
                                <h4 class="text-warning">₦<?= number_format($fuelStats['avg_price'] ?? 0, 2) ?></h4>
                                <small class="text-muted">Average Price/Liter</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4 class="text-danger">₦<?= number_format($fuelStats['monthly_cost'] ?? 0, 0) ?></h4>
                            <small class="text-muted">Monthly Cost</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Reports Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-info">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-download me-2"></i>
                        Generate Reports
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-warning" onclick="generateReport('fleet')">
                                    <i class="fas fa-car me-2"></i>
                                    Fleet Status Report
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-info" onclick="generateReport('fuel')">
                                    <i class="fas fa-gas-pump me-2"></i>
                                    Fuel Consumption Report
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-success" onclick="generateReport('maintenance')">
                                    <i class="fas fa-wrench me-2"></i>
                                    Maintenance Report
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <button class="btn btn-outline-secondary" onclick="generateReport('agency')">
                                    <i class="fas fa-building me-2"></i>
                                    Agency Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function generateReport(type) {
    const reportTypes = {
        'fleet': 'Fleet Status Report',
        'fuel': 'Fuel Consumption Report', 
        'maintenance': 'Maintenance Report',
        'agency': 'Agency Distribution Report'
    };
    
    const reportName = reportTypes[type] || 'Report';
    
    if (confirm(`Generate ${reportName}? This will create a downloadable report with current data.`)) {
        // Show loading state
        event.target.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
        event.target.disabled = true;
        
        // Simulate report generation (in real implementation, this would be an AJAX call)
        setTimeout(() => {
            alert(`${reportName} has been generated successfully!\n\nThis feature will be fully implemented to export PDF/Excel reports with:\n• Current fleet statistics\n• Detailed vehicle listings\n• Cost analysis\n• Performance metrics`);
            
            // Reset button
            event.target.disabled = false;
            event.target.innerHTML = `<i class="fas fa-${getIconForType(type)} me-2"></i>${reportName}`;
        }, 2000);
    }
}

function getIconForType(type) {
    const icons = {
        'fleet': 'car',
        'fuel': 'gas-pump',
        'maintenance': 'wrench', 
        'agency': 'building'
    };
    return icons[type] || 'file';
}
</script>