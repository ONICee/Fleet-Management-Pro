<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-calendar-plus me-2"></i>
                    Schedule Maintenance
                </h1>
                <a href="<?= url('/maintenance') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Maintenance
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-wrench me-2"></i>
                        Maintenance Schedule Details
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= url('/maintenance/schedule') ?>" id="scheduleForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        
                        <!-- Vehicle Selection -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_id" class="form-label text-light">
                                    <i class="fas fa-car me-1"></i>Vehicle *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="vehicle_id" name="vehicle_id" required>
                                    <option value="">Select Vehicle</option>
                                    <?php foreach ($vehicles as $vehicle): ?>
                                        <option value="<?= $vehicle['id'] ?>">
                                            <?= htmlspecialchars($vehicle['vehicle_brand'] . ' ' . $vehicle['vehicle_model']) ?> - 
                                            <?= htmlspecialchars($vehicle['serial_number']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="maintenance_category" class="form-label text-light">
                                    <i class="fas fa-tags me-1"></i>Maintenance Category *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="maintenance_category" name="maintenance_category" required>
                                    <option value="">Select Category</option>
                                    <option value="scheduled">Scheduled (Every 3 months)</option>
                                    <option value="unscheduled">Unscheduled (On need basis)</option>
                                    <option value="overhaul">Overhaul (Annual)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Maintenance Type and Priority -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="maintenance_type" class="form-label text-light">
                                    <i class="fas fa-cog me-1"></i>Maintenance Type *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="maintenance_type" name="maintenance_type" required
                                       placeholder="e.g., Oil Change, Brake Service, Engine Overhaul">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label text-light">
                                    <i class="fas fa-exclamation-circle me-1"></i>Priority
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="priority" name="priority">
                                    <option value="low">Low</option>
                                    <option value="normal" selected>Normal</option>
                                    <option value="high">High</option>
                                    <option value="critical">Critical</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label text-light">
                                <i class="fas fa-clipboard me-1"></i>Description *
                            </label>
                            <textarea class="form-control bg-dark text-light border-secondary" 
                                      id="description" name="description" rows="3" required
                                      placeholder="Detailed description of maintenance work required..."></textarea>
                        </div>

                        <!-- Schedule Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="scheduled_date" class="form-label text-light">
                                    <i class="fas fa-calendar me-1"></i>Scheduled Date *
                                </label>
                                <input type="date" class="form-control bg-dark text-light border-secondary" 
                                       id="scheduled_date" name="scheduled_date" required
                                       min="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mileage_due" class="form-label text-light">
                                    <i class="fas fa-tachometer-alt me-1"></i>Mileage Due (km)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="mileage_due" name="mileage_due" min="0"
                                       placeholder="Expected mileage at service time">
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="service_provider" class="form-label text-light">
                                    <i class="fas fa-building me-1"></i>Service Provider
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="service_provider" name="service_provider"
                                       placeholder="e.g., Toyota Service Center">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estimated_cost" class="form-label text-light">
                                    <i class="fas fa-naira-sign me-1"></i>Estimated Cost (₦)
                                </label>
                                <input type="number" class="form-control bg-dark text-light border-secondary" 
                                       id="estimated_cost" name="estimated_cost" min="0" step="0.01"
                                       placeholder="Expected maintenance cost">
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="work_order_number" class="form-label text-light">
                                    <i class="fas fa-hashtag me-1"></i>Work Order Number
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="work_order_number" name="work_order_number"
                                       placeholder="Internal work order reference">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="parts_replaced" class="form-label text-light">
                                    <i class="fas fa-tools me-1"></i>Parts to Replace
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="parts_replaced" name="parts_replaced"
                                       placeholder="List of parts to be replaced">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label text-light">
                                <i class="fas fa-sticky-note me-1"></i>Additional Notes
                            </label>
                            <textarea class="form-control bg-dark text-light border-secondary" 
                                      id="notes" name="notes" rows="2"
                                      placeholder="Any additional notes or special instructions..."></textarea>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Schedule Maintenance
                            </button>
                            <a href="<?= url('/maintenance') ?>" class="btn btn-outline-secondary px-4">
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
                        Maintenance Guidelines
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <h6 class="text-warning mb-3">Maintenance Categories</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="badge bg-info me-2">Scheduled</span>
                                Every 3 months routine maintenance
                            </li>
                            <li class="mb-2">
                                <span class="badge bg-secondary me-2">Unscheduled</span>
                                On-demand repairs and fixes
                            </li>
                            <li class="mb-2">
                                <span class="badge bg-warning text-dark me-2">Overhaul</span>
                                Annual comprehensive service
                            </li>
                        </ul>

                        <h6 class="text-warning mb-3 mt-4">Priority Levels</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="badge bg-danger me-2">Critical</span>
                                Immediate attention required
                            </li>
                            <li class="mb-2">
                                <span class="badge bg-warning text-dark me-2">High</span>
                                Schedule within a week
                            </li>
                            <li class="mb-2">
                                <span class="badge bg-info me-2">Normal</span>
                                Regular scheduling
                            </li>
                            <li class="mb-2">
                                <span class="badge bg-secondary me-2">Low</span>
                                When convenient
                            </li>
                        </ul>

                        <h6 class="text-warning mb-3 mt-4">Important Notes</h6>
                        <ul class="list-unstyled text-sm">
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Schedule based on vehicle condition</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Consider mileage and usage patterns</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Estimate costs for budget planning</li>
                            <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Include detailed work descriptions</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('scheduleForm').addEventListener('submit', function(e) {
    const requiredFields = ['vehicle_id', 'maintenance_category', 'maintenance_type', 'description', 'scheduled_date'];
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

// Auto-populate maintenance type suggestions based on category
document.getElementById('maintenance_category').addEventListener('change', function() {
    const category = this.value;
    const typeField = document.getElementById('maintenance_type');
    
    const suggestions = {
        'scheduled': 'Oil Change and Filter Replacement',
        'unscheduled': 'Brake Repair',
        'overhaul': 'Engine Overhaul and Inspection'
    };
    
    if (suggestions[category] && !typeField.value) {
        typeField.value = suggestions[category];
    }
});
</script>