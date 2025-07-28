<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add New Vehicle
                </h1>
                <a href="<?= url('/vehicles') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Vehicles
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
                    <form method="POST" action="<?= url('/vehicles/create') ?>" id="vehicleForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        
                        <!-- Basic Vehicle Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_brand" class="form-label text-light">
                                    <i class="fas fa-tag me-1"></i>Vehicle Brand *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vehicle_brand" name="vehicle_brand" required
                                       placeholder="e.g., Toyota, Ford, Peugeot">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_model" class="form-label text-light">
                                    <i class="fas fa-car me-1"></i>Vehicle Model *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vehicle_model" name="vehicle_model" required
                                       placeholder="e.g., Hilux, Ranger, 3008">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serial_number" class="form-label text-light">
                                    <i class="fas fa-barcode me-1"></i>Serial Number *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="serial_number" name="serial_number" required
                                       placeholder="e.g., SPC-001-2024">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="year_allotted" class="form-label text-light">
                                    <i class="fas fa-calendar me-1"></i>Year Allotted *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="year_allotted" name="year_allotted" required>
                                    <option value="">Select Year</option>
                                    <?php for($year = date('Y'); $year >= 2020; $year--): ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="year_manufactured" class="form-label text-light">
                                    <i class="fas fa-industry me-1"></i>Year Manufactured
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="year_manufactured" name="year_manufactured">
                                    <option value="">Select Year</option>
                                    <?php for($year = date('Y'); $year >= 2015; $year--): ?>
                                        <option value="<?= $year ?>"><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Vehicle Type and Fuel -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_type" class="form-label text-light">
                                    <i class="fas fa-shapes me-1"></i>Vehicle Type *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="vehicle_type" name="vehicle_type" required>
                                    <option value="">Select Type</option>
                                    <option value="car">Car</option>
                                    <option value="truck">Truck</option>
                                    <option value="van">Van</option>
                                    <option value="bus">Bus</option>
                                    <option value="motorcycle">Motorcycle</option>
                                    <option value="boat">Boat</option>
                                    <option value="helicopter">Helicopter</option>
                                    <option value="drone">Drone</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fuel_type" class="form-label text-light">
                                    <i class="fas fa-gas-pump me-1"></i>Fuel Type *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="fuel_type" name="fuel_type" required>
                                    <option value="">Select Fuel Type</option>
                                    <option value="gasoline">Gasoline</option>
                                    <option value="diesel">Diesel</option>
                                    <option value="electric">Electric</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="jet_fuel">Jet Fuel</option>
                                    <option value="battery">Battery</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Vehicle Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="engine_number" class="form-label text-light">
                                    <i class="fas fa-cog me-1"></i>Engine Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="engine_number" name="engine_number"
                                       placeholder="Engine identification number">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="chassis_number" class="form-label text-light">
                                    <i class="fas fa-wrench me-1"></i>Chassis Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="chassis_number" name="chassis_number"
                                       placeholder="Chassis identification number">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="license_plate" class="form-label text-light">
                                    <i class="fas fa-id-card me-1"></i>License Plate
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="license_plate" name="license_plate"
                                       placeholder="e.g., ABC-123">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="vin" class="form-label text-light">
                                    <i class="fas fa-fingerprint me-1"></i>VIN
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="vin" name="vin" maxlength="17"
                                       placeholder="Vehicle Identification Number">
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
                                       placeholder="GPS tracker number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tracker_imei" class="form-label text-light">
                                    <i class="fas fa-mobile-alt me-1"></i>Tracker IMEI
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="tracker_imei" name="tracker_imei"
                                       placeholder="15-digit IMEI number">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tracker_status" class="form-label text-light">
                                    <i class="fas fa-signal me-1"></i>Tracker Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="tracker_status" name="tracker_status">
                                    <option value="not_installed">Not Installed</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
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
                                        <option value="<?= $agency['id'] ?>">
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
                                        <option value="<?= $location['id'] ?>">
                                            <?= htmlspecialchars($location['location_name']) ?> 
                                            (<?= htmlspecialchars($location['local_government']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Vehicle Status -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serviceability" class="form-label text-light">
                                    <i class="fas fa-tools me-1"></i>Serviceability Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="serviceability" name="serviceability">
                                    <option value="serviceable">Serviceable</option>
                                    <option value="unserviceable">Unserviceable</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="current_mileage" class="form-label text-light">
                                    <i class="fas fa-tachometer-alt me-1"></i>Current Mileage (km)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="current_mileage" name="current_mileage" min="0"
                                       placeholder="0">
                            </div>
                        </div>

                        <!-- Purchase Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="purchase_date" class="form-label text-light">
                                    <i class="fas fa-calendar-alt me-1"></i>Purchase Date
                                </label>
                                <input type="date" class="form-control bg-dark text-light border-secondary" 
                                       id="purchase_date" name="purchase_date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purchase_price" class="form-label text-light">
                                    <i class="fas fa-naira-sign me-1"></i>Purchase Price (₦)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="purchase_price" name="purchase_price" min="0" step="0.01"
                                       placeholder="0.00">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="supplier" class="form-label text-light">
                                <i class="fas fa-store me-1"></i>Supplier/Vendor
                            </label>
                            <input type="text" class="form-control bg-dark text-light border-secondary" 
                                   id="supplier" name="supplier"
                                   placeholder="Vehicle supplier or dealership">
                        </div>

                        <!-- Condition Notes -->
                        <div class="mb-4">
                            <label for="current_condition" class="form-label text-light">
                                <i class="fas fa-clipboard-list me-1"></i>Current Condition/Notes
                            </label>
                            <textarea class="form-control bg-dark text-light border-secondary" 
                                      id="current_condition" name="current_condition" rows="3"
                                      placeholder="Describe the current condition of the vehicle..."></textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>
                                Add Vehicle
                            </button>
                            <a href="<?= url('/vehicles') ?>" class="btn btn-outline-secondary px-4">
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
                        Quick Guide
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <h6 class="text-warning mb-3">Required Fields</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Vehicle Brand & Model</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Serial Number</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Year Allotted</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Vehicle Type</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fuel Type</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Assigned Agency</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Deployment Location</li>
                        </ul>

                        <h6 class="text-warning mb-3 mt-4">Tips</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Use consistent serial number format</li>
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Include tracker details for monitoring</li>
                            <li class="mb-2"><i class="fas fa-lightbulb text-warning me-2"></i>Add purchase information for records</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('vehicleForm').addEventListener('submit', function(e) {
    const requiredFields = ['vehicle_brand', 'vehicle_model', 'serial_number', 'year_allotted', 'vehicle_type', 'fuel_type', 'agency_id', 'deployment_location_id'];
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