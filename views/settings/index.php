<div class="container-fluid py-4">
    <h1 class="text-warning mb-4"><i class="fas fa-cog me-2"></i>System Settings</h1>
    <form action="<?= url('/settings/update') ?>" method="POST" class="bg-dark p-4 rounded border border-warning" style="max-width:600px;">
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="tracker_enabled" name="tracker_enabled" value="1" <?= $trackerEnabled=='1'?'checked':''; ?>>
            <label class="form-check-label" for="tracker_enabled">Enable Tracker API Integration</label>
        </div>
        <div class="mb-3">
            <label for="tracker_url" class="form-label">Tracker API Base URL</label>
            <input type="text" class="form-control" id="tracker_url" name="tracker_url" value="<?= e($trackerUrl) ?>">
        </div>
        <div class="mb-3">
            <label for="tracker_token" class="form-label">Tracker API Token</label>
            <input type="text" class="form-control" id="tracker_token" name="tracker_token" value="<?= e($trackerToken) ?>">
        </div>
        <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i>Save Settings</button>
    </form>
</div>