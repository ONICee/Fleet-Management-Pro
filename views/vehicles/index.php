<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-car me-2"></i>
                    Vehicle Management
                </h1>
                <a href="<?= url('/vehicles/create') ?>" class="btn btn-warning">
                    <i class="fas fa-plus me-2"></i>
                    Add New Vehicle
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-secondary">
                <div class="card-body">
                    <form method="GET" class="row g-3" id="filterForm">
                        <div class="col-md-3">
                            <label for="search" class="form-label text-light">Search</label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" 
                                   id="search" name="search" placeholder="Brand, model, serial..." 
                                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="agency" class="form-label text-light">Agency</label>
                            <select class="form-control bg-dark text-light border-secondary" id="agency" name="agency">
                                <option value="">All Agencies</option>
                                <?php foreach ($agencies as $agency): ?>
                                    <option value="<?= $agency['id'] ?>" <?= ($_GET['agency'] ?? '') == $agency['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($agency['agency_code']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="serviceability" class="form-label text-light">Status</label>
                            <select class="form-control bg-dark text-light border-secondary" id="serviceability" name="filter">
                                <option value="">All Vehicles</option>
                                <option value="serviceable" <?= ($_GET['filter'] ?? '') === 'serviceable' ? 'selected' : '' ?>>Serviceable</option>
                                <option value="unserviceable" <?= ($_GET['filter'] ?? '') === 'unserviceable' ? 'selected' : '' ?>>Unserviceable</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="vehicle_type" class="form-label text-light">Type</label>
                            <select class="form-control bg-dark text-light border-secondary" id="vehicle_type" name="vehicle_type">
                                <option value="">All Types</option>
                                <option value="car" <?= ($_GET['vehicle_type'] ?? '') === 'car' ? 'selected' : '' ?>>Car</option>
                                <option value="truck" <?= ($_GET['vehicle_type'] ?? '') === 'truck' ? 'selected' : '' ?>>Truck/SUV</option>
                                <option value="van" <?= ($_GET['vehicle_type'] ?? '') === 'van' ? 'selected' : '' ?>>Van</option>
                                <option value="bus" <?= ($_GET['vehicle_type'] ?? '') === 'bus' ? 'selected' : '' ?>>Bus</option>
                                <option value="motorcycle" <?= ($_GET['vehicle_type'] ?? '') === 'motorcycle' ? 'selected' : '' ?>>Motorcycle</option>
                                <option value="boat" <?= ($_GET['vehicle_type'] ?? '') === 'boat' ? 'selected' : '' ?>>Boat</option>
                                <option value="drone" <?= ($_GET['vehicle_type'] ?? '') === 'drone' ? 'selected' : '' ?>>Drone</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-warning me-2">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="<?= url('/vehicles') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body text-center">
                    <div class="text-warning">
                        <i class="fas fa-car fa-2x mb-2"></i>
                        <h5>Total Vehicles</h5>
                        <h3 class="text-light"><?= $stats['total'] ?? 0 ?></h3>
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
                        <h3 class="text-light"><?= $stats['serviceable'] ?? 0 ?></h3>
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
                        <h3 class="text-light"><?= $stats['unserviceable'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body text-center">
                    <div class="text-info">
                        <i class="fas fa-wrench fa-2x mb-2"></i>
                        <h5>In Maintenance</h5>
                        <h3 class="text-light"><?= $stats['in_maintenance'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles Table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Vehicle Inventory
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($vehicles)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-car fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Vehicles Found</h4>
                            <p class="text-muted">Start by adding your first vehicle to the fleet.</p>
                            <a href="<?= url('/vehicles/create') ?>" class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>
                                Add First Vehicle
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>S/N</th>
                                        <th><i class="fas fa-car me-1"></i>Brand/Model</th>
                                        <th><i class="fas fa-barcode me-1"></i>Serial Number</th>
                                        <th><i class="fas fa-building me-1"></i>Agency</th>
                                        <th><i class="fas fa-map-marker-alt me-1"></i>Location</th>
                                        <th><i class="fas fa-tools me-1"></i>Status</th>
                                        <th><i class="fas fa-gps-dot me-1"></i>Tracker</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicles as $index => $vehicle): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong class="text-warning"><?= htmlspecialchars($vehicle['vehicle_brand']) ?></strong><br>
                                                <small class="text-muted"><?= htmlspecialchars($vehicle['vehicle_model']) ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($vehicle['serial_number']) ?></span>
                                            </td>
                                            <td>
                                                <span class="text-info"><?= htmlspecialchars($vehicle['agency_name'] ?? 'N/A') ?></span><br>
                                                <small class="text-muted"><?= htmlspecialchars($vehicle['agency_code'] ?? '') ?></small>
                                            </td>
                                            <td>
                                                <span class="text-light"><?= htmlspecialchars($vehicle['location_name'] ?? 'N/A') ?></span>
                                            </td>
                                            <td>
                                                <?php if ($vehicle['serviceability'] === 'serviceable'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Serviceable
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i>Unserviceable
                                                    </span>
                                                <?php endif; ?>
                                            </td>
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
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?= url('/vehicles/view/' . $vehicle['id']) ?>" 
                                                       class="btn btn-outline-info" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php if (in_array($userRole, ['super_admin', 'admin', 'data_entry_officer'])): ?>
                                                        <a href="<?= url('/vehicles/edit/' . $vehicle['id']) ?>" 
                                                           class="btn btn-outline-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (in_array($userRole, ['super_admin', 'admin'])): ?>
                                                        <button type="button" 
                                                                class="btn btn-outline-danger" 
                                                                title="Delete"
                                                                onclick="confirmDelete(<?= $vehicle['id'] ?>, '<?= htmlspecialchars($vehicle['vehicle_brand'] . ' ' . $vehicle['vehicle_model']) ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
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

<script>
function confirmDelete(vehicleId, vehicleName) {
    if (confirm(`Are you sure you want to delete "${vehicleName}"? This action cannot be undone.`)) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= url('/vehicles/delete/') ?>' + vehicleId;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = 'csrf_token';
        csrfToken.value = '<?= $csrfToken ?>';
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>