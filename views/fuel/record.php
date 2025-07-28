<div class="container-fluid py-4" style="max-width:800px;">
    <h1 class="text-warning mb-4"><i class="fas fa-gas-pump me-2"></i>Record Fuel</h1>

    <form action="<?= url('/fuel/record') ?>" method="POST" class="card bg-dark border-warning p-4">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-light">Vehicle *</label>
                <select name="vehicle_id" class="form-control bg-dark text-light border-secondary" required>
                    <option value="">Select vehicle</option>
                    <?php foreach ($vehicles as $v): ?>
                        <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['vehicle_brand'].' '.$v['vehicle_model'].' ('.$v['serial_number'].')') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label text-light">Driver</label>
                <select name="driver_id" class="form-control bg-dark text-light border-secondary">
                    <option value="">Select driver (optional)</option>
                    <?php foreach ($drivers as $d): ?>
                        <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['first_name'].' '.$d['last_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label text-light">Fuel Station *</label>
                <input type="text" name="fuel_station" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-light">Fuel Type *</label>
                <select name="fuel_type" class="form-control bg-dark text-light border-secondary" required>
                    <option value="gasoline">Gasoline</option>
                    <option value="diesel">Diesel</option>
                    <option value="electric">Electric</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-light">Date *</label>
                <input type="date" name="fuel_date" value="<?= date('Y-m-d') ?>" class="form-control bg-dark text-light border-secondary" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label text-light">Quantity (L) *</label>
                <input type="number" step="0.01" name="quantity" id="quantity" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Price per Liter (₦) *</label>
                <input type="number" step="0.001" name="price_per_unit" id="price" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Total Cost (₦)</label>
                <input type="number" step="0.01" name="total_cost" id="total" class="form-control bg-dark text-light border-secondary" readonly>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label text-light">Mileage at Fill-up (km)</label>
                <input type="number" name="mileage_at_fillup" class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Receipt #</label>
                <input type="text" name="receipt_number" class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-4">
                <label class="form-label text-light">Location</label>
                <input type="text" name="location" class="form-control bg-dark text-light border-secondary">
            </div>
        </div>

        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i>Save Record</button>
    </form>
</div>

<script>
    const qty  = document.getElementById('quantity');
    const price= document.getElementById('price');
    const total= document.getElementById('total');

    function calc(){
        const q = parseFloat(qty.value) || 0;
        const p = parseFloat(price.value) || 0;
        total.value = (q*p).toFixed(2);
    }
    qty.addEventListener('input',calc);
    price.addEventListener('input',calc);
</script>