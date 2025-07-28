<div class="container-fluid py-4" style="max-width:800px;">
    <h1 class="text-warning mb-4"><i class="fas fa-tools me-2"></i>Complete Maintenance</h1>
    <p class="text-light">Vehicle: <span class="text-warning fw-bold"><?= htmlspecialchars($schedule['vehicle_brand'].' '.$schedule['vehicle_model'].' ('.$schedule['serial_number'].')') ?></span></p>

    <form action="<?= url('/maintenance/complete/'.$schedule['id']) ?>" method="POST" class="card bg-dark border-warning p-4">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-light">Maintenance Date *</label>
                <input type="date" name="maintenance_date" class="form-control bg-dark text-light border-secondary" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label text-light">Service Provider</label>
                <input type="text" name="service_provider" class="form-control bg-dark text-light border-secondary" value="<?= htmlspecialchars($schedule['service_provider'] ?? '') ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Work Performed *</label>
            <textarea name="work_performed" class="form-control bg-dark text-light border-secondary" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Parts Used</label>
            <textarea name="parts_used" class="form-control bg-dark text-light border-secondary" rows="2"></textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label text-light">Cost (₦)</label>
                <input type="number" step="0.01" name="cost" class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Mileage at Service (km)</label>
                <input type="number" name="mileage_at_service" class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Technician Name</label>
                <input type="text" name="technician_name" class="form-control bg-dark text-light border-secondary">
            </div>
        </div>

        <button type="submit" class="btn btn-warning"><i class="fas fa-check me-2"></i>Mark as Completed</button>
    </form>
</div>