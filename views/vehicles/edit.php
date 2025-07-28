<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-edit me-2"></i>
                    Edit Vehicle: <?= htmlspecialchars($vehicle['vehicle_brand'] . ' ' . $vehicle['vehicle_model']) ?>
                </h1>
                <a href="<?= url('/vehicles/view/' . $vehicle['id']) ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Details
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i>
                        Vehicle Information
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= url('/vehicles/edit/' . $vehicle['id']) ?>" id="vehicleEditForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        
                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_brand" class="form-label text-light">
                                    <i class="fas fa-car me-1"></i>Vehicle Brand *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vehicle_brand" name="vehicle_brand" required
                                       value="<?= htmlspecialchars($vehicle['vehicle_brand']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_model" class="form-label text-light">
                                    <i class="fas fa-car me-1"></i>Vehicle Model *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vehicle_model" name="vehicle_model" required
                                       value="<?= htmlspecialchars($vehicle['vehicle_model']) ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serial_number" class="form-label text-light">
                                    <i class="fas fa-barcode me-1"></i>Serial Number *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="serial_number" name="serial_number" required
                                       value="<?= htmlspecialchars($vehicle['serial_number']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="license_plate" class="form-label text-light">
                                    <i class="fas fa-id-card me-1"></i>License Plate
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="license_plate" name="license_plate"
                                       value="<?= htmlspecialchars($vehicle['license_plate'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Years and Type -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="year_allotted" class="form-label text-light">
                                    <i class="fas fa-calendar me-1"></i>Year Allotted *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="year_allotted" name="year_allotted" required>
                                    <?php for ($year = date('Y') + 2; $year >= 2020; $year--): ?>
                                        <option value="<?= $year ?>" <?= $vehicle['year_allotted'] == $year ? 'selected' : '' ?>>
                                            <?= $year ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="year_manufactured" class="form-label text-light">
                                    <i class="fas fa-industry me-1"></i>Year Manufactured
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="year_manufactured" name="year_manufactured">
                                    <option value="">Select Year</option>
                                    <?php for ($year = date('Y') + 1; $year >= 2015; $year--): ?>
                                        <option value="<?= $year ?>" <?= $vehicle['year_manufactured'] == $year ? 'selected' : '' ?>>
                                            <?= $year ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="current_mileage" class="form-label text-light">
                                    <i class="fas fa-tachometer-alt me-1"></i>Current Mileage (km)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="current_mileage" name="current_mileage" min="0"
                                       value="<?= htmlspecialchars($vehicle['current_mileage'] ?? 0) ?>">
                            </div>
                        </div>

                        <!-- Vehicle Type and Fuel -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_type" class="form-label text-light">
                                    <i class="fas fa-cogs me-1"></i>Vehicle Type *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="vehicle_type" name="vehicle_type" required>
                                    <option value="car" <?= $vehicle['vehicle_type'] === 'car' ? 'selected' : '' ?>>Car</option>
                                    <option value="truck" <?= $vehicle['vehicle_type'] === 'truck' ? 'selected' : '' ?>>Truck/SUV</option>
                                    <option value="van" <?= $vehicle['vehicle_type'] === 'van' ? 'selected' : '' ?>>Van</option>
                                    <option value="bus" <?= $vehicle['vehicle_type'] === 'bus' ? 'selected' : '' ?>>Bus</option>
                                    <option value="motorcycle" <?= $vehicle['vehicle_type'] === 'motorcycle' ? 'selected' : '' ?>>Motorcycle</option>
                                    <option value="boat" <?= $vehicle['vehicle_type'] === 'boat' ? 'selected' : '' ?>>Boat</option>
                                    <option value="helicopter" <?= $vehicle['vehicle_type'] === 'helicopter' ? 'selected' : '' ?>>Helicopter</option>
                                    <option value="drone" <?= $vehicle['vehicle_type'] === 'drone' ? 'selected' : '' ?>>Drone</option>
                                    <option value="other" <?= $vehicle['vehicle_type'] === 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fuel_type" class="form-label text-light">
                                    <i class="fas fa-gas-pump me-1"></i>Fuel Type *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="fuel_type" name="fuel_type" required>
                                    <option value="gasoline" <?= $vehicle['fuel_type'] === 'gasoline' ? 'selected' : '' ?>>Gasoline/Petrol</option>
                                    <option value="diesel" <?= $vehicle['fuel_type'] === 'diesel' ? 'selected' : '' ?>>Diesel</option>
                                    <option value="electric" <?= $vehicle['fuel_type'] === 'electric' ? 'selected' : '' ?>>Electric</option>
                                    <option value="hybrid" <?= $vehicle['fuel_type'] === 'hybrid' ? 'selected' : '' ?>>Hybrid</option>
                                    <option value="battery" <?= $vehicle['fuel_type'] === 'battery' ? 'selected' : '' ?>>Battery</option>
                                    <option value="jet_fuel" <?= $vehicle['fuel_type'] === 'jet_fuel' ? 'selected' : '' ?>>Jet Fuel</option>
                                    <option value="other" <?= $vehicle['fuel_type'] === 'other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Technical Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="engine_number" class="form-label text-light">
                                    <i class="fas fa-engine me-1"></i>Engine Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="engine_number" name="engine_number"
                                       value="<?= htmlspecialchars($vehicle['engine_number'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="chassis_number" class="form-label text-light">
                                    <i class="fas fa-car-chassis me-1"></i>Chassis Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="chassis_number" name="chassis_number"
                                       value="<?= htmlspecialchars($vehicle['chassis_number'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vin" class="form-label text-light">
                                    <i class="fas fa-fingerprint me-1"></i>VIN (Vehicle Identification Number)
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vin" name="vin" maxlength="17"
                                       value="<?= htmlspecialchars($vehicle['vin'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="supplier" class="form-label text-light">
                                    <i class="fas fa-store me-1"></i>Supplier/Dealer
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="supplier" name="supplier"
                                       value="<?= htmlspecialchars($vehicle['supplier'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Assignment -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="agency_id" class="form-label text-light">
                                    <i class="fas fa-building me-1"></i>Assigned Agency *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="agency_id" name="agency_id" required>
                                    <option value="">Select Agency</option>
                                    <?php foreach ($agencies as $agency): ?>
                                        <option value="<?= $agency['id'] ?>" <?= $vehicle['agency_id'] == $agency['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($agency['agency_name']) ?> (<?= htmlspecialchars($agency['agency_code']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="deployment_location_id" class="form-label text-light">
                                    <i class="fas fa-map-marker-alt me-1"></i>Deployment Location *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="deployment_location_id" name="deployment_location_id" required>
                                    <option value="">Select Location</option>
                                    <?php foreach ($locations as $location): ?>
                                        <option value="<?= $location['id'] ?>" <?= $vehicle['deployment_location_id'] == $location['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($location['location_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tracker Information -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tracker_number" class="form-label text-light">
                                    <i class="fas fa-satellite-dish me-1"></i>Tracker Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="tracker_number" name="tracker_number"
                                       value="<?= htmlspecialchars($vehicle['tracker_number'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tracker_imei" class="form-label text-light">
                                    <i class="fas fa-mobile-alt me-1"></i>Tracker IMEI
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="tracker_imei" name="tracker_imei"
                                       value="<?= htmlspecialchars($vehicle['tracker_imei'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tracker_status" class="form-label text-light">
                                    <i class="fas fa-signal me-1"></i>Tracker Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="tracker_status" name="tracker_status">
                                    <option value="not_installed" <?= $vehicle['tracker_status'] === 'not_installed' ? 'selected' : '' ?>>Not Installed</option>
                                    <option value="active" <?= $vehicle['tracker_status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $vehicle['tracker_status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status and Serviceability -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serviceability" class="form-label text-light">
                                    <i class="fas fa-tools me-1"></i>Serviceability *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="serviceability" name="serviceability" required>
                                    <option value="serviceable" <?= $vehicle['serviceability'] === 'serviceable' ? 'selected' : '' ?>>Serviceable</option>
                                    <option value="unserviceable" <?= $vehicle['serviceability'] === 'unserviceable' ? 'selected' : '' ?>>Unserviceable</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label text-light">
                                    <i class="fas fa-flag me-1"></i>Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="status" name="status">
                                    <option value="active" <?= $vehicle['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $vehicle['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="maintenance" <?= $vehicle['status'] === 'maintenance' ? 'selected' : '' ?>>In Maintenance</option>
                                    <option value="decommissioned" <?= $vehicle['status'] === 'decommissioned' ? 'selected' : '' ?>>Decommissioned</option>
                                </select>
                            </div>
                        </div>

                        <!-- Current Condition -->
                        <div class="mb-3">
                            <label for="current_condition" class="form-label text-light">
                                <i class="fas fa-clipboard-check me-1"></i>Current Condition
                            </label>
                            <textarea class="form-control bg-dark text-light border-secondary" 
                                      id="current_condition" name="current_condition" rows="3"
                                      placeholder="Describe the current condition of the vehicle..."><?= htmlspecialchars($vehicle['current_condition'] ?? '') ?></textarea>
                        </div>

                        <!-- Purchase Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="purchase_date" class="form-label text-light">
                                    <i class="fas fa-calendar me-1"></i>Purchase Date
                                </label>
                                <input type="date" class="form-control bg-dark text-light border-secondary" 
                                       id="purchase_date" name="purchase_date"
                                       value="<?= htmlspecialchars($vehicle['purchase_date'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purchase_price" class="form-label text-light">
                                    <i class="fas fa-naira-sign me-1"></i>Purchase Price (₦)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="purchase_price" name="purchase_price" min="0" step="0.01"
                                       value="<?= htmlspecialchars($vehicle['purchase_price'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Insurance Information -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="insurance_policy" class="form-label text-light">
                                    <i class="fas fa-shield-alt me-1"></i>Insurance Policy
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="insurance_policy" name="insurance_policy"
                                       value="<?= htmlspecialchars($vehicle['insurance_policy'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="insurance_expiry" class="form-label text-light">
                                    <i class="fas fa-calendar-times me-1"></i>Insurance Expiry
                                </label>
                                <input type="date" class="form-control bg-dark text-light border-secondary" 
                                       id="insurance_expiry" name="insurance_expiry"
                                       value="<?= htmlspecialchars($vehicle['insurance_expiry'] ?? '') ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="registration_expiry" class="form-label text-light">
                                    <i class="fas fa-id-card me-1"></i>Registration Expiry
                                </label>
                                <input type="date" class="form-control bg-dark text-light border-secondary" 
                                       id="registration_expiry" name="registration_expiry"
                                       value="<?= htmlspecialchars($vehicle['registration_expiry'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>
                                Update Vehicle
                            </button>
                            <a href="<?= url('/vehicles/view/' . $vehicle['id']) ?>" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-dark border-info">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Edit Instructions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <h6 class="text-warning mb-3">Required Fields</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Vehicle Brand & Model</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Serial Number (Unique)</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Year Allotted</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Vehicle Type</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fuel Type</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Agency Assignment</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Deployment Location</li>
                        </ul>

                        <h6 class="text-warning mb-3 mt-4">Tips</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Use consistent naming</li>
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Keep records up to date</li>
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Update mileage regularly</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('vehicleEditForm').addEventListener('submit', function(e) {
    const requiredFields = ['vehicle_brand', 'vehicle_model', 'serial_number', 'year_allotted', 'vehicle_type', 'fuel_type', 'agency_id', 'deployment_location_id', 'serviceability'];
    let hasError = false;
    
    requiredFields.forEach(function(fieldName) {
        const field = document.getElementById(fieldName);
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            hasError = true;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (hasError) {
        e.preventDefault();
        alert('Please fill in all required fields marked with (*)');
    }
});

// Remove invalid class on input
document.querySelectorAll('input, select, textarea').forEach(function(element) {
    element.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
});
</script>