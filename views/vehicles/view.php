<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-car me-2"></i>
                    Vehicle Details: <?= htmlspecialchars($vehicle['vehicle_brand'] . ' ' . $vehicle['vehicle_model']) ?>
                </h1>
                <div>
                    <?php if (in_array($userRole, ['super_admin', 'admin', 'data_entry_officer'])): ?>
                        <a href="<?= url('/vehicles/edit/' . $vehicle['id']) ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Vehicle
                        </a>
                    <?php endif; ?>
                    <a href="<?= url('/vehicles') ?>" class="btn btn-outline-warning">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Vehicles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Vehicle Information -->
        <div class="col-lg-8">
            <div class="card bg-dark border-warning mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Vehicle Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-warning fw-bold">Brand/Model:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['vehicle_brand'] . ' ' . $vehicle['vehicle_model']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Serial Number:</td>
                                    <td>
                                        <span class="badge bg-secondary fs-6"><?= htmlspecialchars($vehicle['serial_number']) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Year Allotted:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['year_allotted']) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Year Manufactured:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['year_manufactured'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Vehicle Type:</td>
                                    <td>
                                        <span class="badge bg-info"><?= ucfirst(htmlspecialchars($vehicle['vehicle_type'])) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Fuel Type:</td>
                                    <td>
                                        <span class="badge bg-success"><?= ucfirst(htmlspecialchars($vehicle['fuel_type'])) ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">License Plate:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['license_plate'] ?? 'N/A') ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-warning fw-bold">Engine Number:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['engine_number'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Chassis Number:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['chassis_number'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">VIN:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['vin'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Current Mileage:</td>
                                    <td class="text-light"><?= number_format($vehicle['current_mileage'] ?? 0) ?> km</td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Purchase Date:</td>
                                    <td class="text-light"><?= $vehicle['purchase_date'] ? date('M j, Y', strtotime($vehicle['purchase_date'])) : 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Purchase Price:</td>
                                    <td class="text-light"><?= $vehicle['purchase_price'] ? '₦' . number_format($vehicle['purchase_price'], 2) : 'N/A' ?></td>
                                </tr>
                                <tr>
                                    <td class="text-warning fw-bold">Supplier:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['supplier'] ?? 'N/A') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment Information -->
            <div class="card bg-dark border-info mb-4">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-building me-2"></i>
                        Assignment Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-info fw-bold">Agency:</td>
                                    <td>
                                        <span class="text-light"><?= htmlspecialchars($vehicle['agency_name'] ?? 'N/A') ?></span><br>
                                        <small class="text-muted"><?= htmlspecialchars($vehicle['agency_code'] ?? '') ?></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-info fw-bold">Agency Type:</td>
                                    <td>
                                        <span class="badge bg-<?= $vehicle['agency_type'] === 'federal' ? 'primary' : ($vehicle['agency_type'] === 'state' ? 'warning text-dark' : 'secondary') ?>">
                                            <?= ucfirst(htmlspecialchars($vehicle['agency_type'] ?? 'N/A')) ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-info fw-bold">Deployment Location:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['location_name'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-info fw-bold">Local Government:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['local_government'] ?? 'N/A') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tracker Information -->
            <div class="card bg-dark border-success mb-4">
                <div class="card-header bg-success text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-satellite-dish me-2"></i>
                        Tracker Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-success fw-bold">Tracker Number:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['tracker_number'] ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-success fw-bold">Tracker IMEI:</td>
                                    <td class="text-light"><?= htmlspecialchars($vehicle['tracker_imei'] ?? 'N/A') ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-dark table-borderless">
                                <tr>
                                    <td class="text-success fw-bold">Tracker Status:</td>
                                    <td>
                                        <?php if ($vehicle['tracker_status'] === 'active'): ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-satellite-dish me-1"></i>Active
                                            </span>
                                        <?php elseif ($vehicle['tracker_status'] === 'inactive'): ?>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Inactive
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-minus me-1"></i>Not Installed
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if (!empty($vehicle['current_lat']) && !empty($vehicle['current_lng'])): ?>
                                <tr>
                                    <td class="text-success fw-bold">Last Location:</td>
                                    <td class="text-light">
                                        <?= htmlspecialchars($vehicle['current_lat']) ?>, <?= htmlspecialchars($vehicle['current_lng']) ?>
                                        <a href="<?= map_link($vehicle['current_lat'],$vehicle['current_lng']) ?>" target="_blank" class="ms-2 text-warning">
                                            <i class="fas fa-map-marker-alt"></i> View Map
                                        </a><br>
                                        <small class="text-muted">Updated: <?= formatDate($vehicle['last_fix_at'],'M j, Y H:i') ?></small>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status and Maintenance -->
        <div class="col-lg-4">
            <!-- Current Status -->
            <div class="card bg-dark border-warning mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-tools me-2"></i>
                        Current Status
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <?php if ($vehicle['serviceability'] === 'serviceable'): ?>
                            <span class="badge bg-success fs-5 px-3 py-2">
                                <i class="fas fa-check me-2"></i>Serviceable
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger fs-5 px-3 py-2">
                                <i class="fas fa-times me-2"></i>Unserviceable
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-<?= $vehicle['status'] === 'active' ? 'success' : ($vehicle['status'] === 'maintenance' ? 'warning text-dark' : 'secondary') ?> fs-6 px-3 py-2">
                            <?= ucfirst(htmlspecialchars($vehicle['status'] ?? 'active')) ?>
                        </span>
                    </div>
                    <?php if ($vehicle['current_condition']): ?>
                        <div class="alert alert-info">
                            <small><strong>Condition:</strong><br><?= htmlspecialchars($vehicle['current_condition']) ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Maintenance Schedule -->
            <div class="card bg-dark border-info mb-4">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Maintenance Schedule
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-borderless table-sm">
                        <tr>
                            <td class="text-info fw-bold">Last Overhaul:</td>
                            <td class="text-light"><?= $vehicle['last_overhaul'] ? date('M j, Y', strtotime($vehicle['last_overhaul'])) : 'Never' ?></td>
                        </tr>
                        <tr>
                            <td class="text-info fw-bold">Next Overhaul:</td>
                            <td class="text-light"><?= $vehicle['next_overhaul'] ? date('M j, Y', strtotime($vehicle['next_overhaul'])) : 'Not Scheduled' ?></td>
                        </tr>
                        <tr>
                            <td class="text-info fw-bold">Last Maintenance:</td>
                            <td class="text-light"><?= $vehicle['last_scheduled_maintenance'] ? date('M j, Y', strtotime($vehicle['last_scheduled_maintenance'])) : 'Never' ?></td>
                        </tr>
                        <tr>
                            <td class="text-info fw-bold">Next Maintenance:</td>
                            <td class="text-light"><?= $vehicle['next_scheduled_maintenance'] ? date('M j, Y', strtotime($vehicle['next_scheduled_maintenance'])) : 'Not Scheduled' ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Insurance Information -->
            <div class="card bg-dark border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Insurance & Registration
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-borderless table-sm">
                        <tr>
                            <td class="text-danger fw-bold">Insurance Policy:</td>
                            <td class="text-light"><?= htmlspecialchars($vehicle['insurance_policy'] ?? 'N/A') ?></td>
                        </tr>
                        <tr>
                            <td class="text-danger fw-bold">Insurance Expiry:</td>
                            <td class="text-light"><?= $vehicle['insurance_expiry'] ? date('M j, Y', strtotime($vehicle['insurance_expiry'])) : 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td class="text-danger fw-bold">Registration Expiry:</td>
                            <td class="text-light"><?= $vehicle['registration_expiry'] ? date('M j, Y', strtotime($vehicle['registration_expiry'])) : 'N/A' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance History -->
    <?php if (!empty($maintenanceHistory)): ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark border-secondary">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Maintenance History
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Work Performed</th>
                                    <th>Cost</th>
                                    <th>Service Provider</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($maintenanceHistory as $maintenance): ?>
                                <tr>
                                    <td><?= date('M j, Y', strtotime($maintenance['maintenance_date'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $maintenance['maintenance_category'] === 'scheduled' ? 'success' : ($maintenance['maintenance_category'] === 'overhaul' ? 'warning text-dark' : 'danger') ?>">
                                            <?= ucfirst($maintenance['maintenance_category']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($maintenance['maintenance_type'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($maintenance['work_performed']) ?></td>
                                    <td><?= $maintenance['cost'] ? '₦' . number_format($maintenance['cost'], 2) : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($maintenance['service_provider'] ?? 'N/A') ?></td>
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