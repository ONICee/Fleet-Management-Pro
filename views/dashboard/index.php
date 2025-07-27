<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </h1>
                <div class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    <?= date('l, F j, Y') ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="text-warning mb-2">
                                Welcome back, <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>!
                            </h4>
                            <p class="text-muted mb-0">
                                <i class="fas fa-user-tag me-2"></i>
                                Role: <span class="text-warning"><?= ucfirst(str_replace('_', ' ', $user['role'])) ?></span>
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="text-muted">
                                <small>Last Login:</small><br>
                                <span class="text-warning">
                                    <?= $user['last_login'] ? date('M j, Y g:i A', strtotime($user['last_login'])) : 'First time login' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Vehicles
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-light">
                                <?= $vehicleStats['total'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark border-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Serviceable
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-light">
                                <?= $vehicleStats['serviceable'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark border-danger h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Unserviceable
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-light">
                                <?= $vehicleStats['unserviceable'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-dark border-info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Agencies
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-light">
                                <?= $agencyStats['total'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="<?= url('/vehicles') ?>" class="btn btn-outline-warning btn-lg w-100">
                                <i class="fas fa-car fa-2x d-block mb-2"></i>
                                View Vehicles
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= url('/maintenance') ?>" class="btn btn-outline-info btn-lg w-100">
                                <i class="fas fa-wrench fa-2x d-block mb-2"></i>
                                Maintenance
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= url('/reports') ?>" class="btn btn-outline-success btn-lg w-100">
                                <i class="fas fa-chart-bar fa-2x d-block mb-2"></i>
                                Reports
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= url('/agencies') ?>" class="btn btn-outline-light btn-lg w-100">
                                <i class="fas fa-building fa-2x d-block mb-2"></i>
                                Agencies
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-success">
                <div class="card-header bg-success text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-heartbeat me-2"></i>
                        System Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="text-success">
                                <i class="fas fa-database fa-3x mb-2"></i>
                                <h6>Database</h6>
                                <span class="badge bg-success">Online</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-warning">
                                <i class="fas fa-server fa-3x mb-2"></i>
                                <h6>Application</h6>
                                <span class="badge bg-warning text-dark">Running</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-info">
                                <i class="fas fa-shield-alt fa-3x mb-2"></i>
                                <h6>Security</h6>
                                <span class="badge bg-info">Protected</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-light">
                                <i class="fas fa-clock fa-3x mb-2"></i>
                                <h6>Uptime</h6>
                                <span class="badge bg-light text-dark">24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Dashboard initialization
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard loaded successfully');
    
    // Add any dashboard-specific JavaScript here
});
</script>