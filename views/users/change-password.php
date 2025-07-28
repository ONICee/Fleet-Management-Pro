<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-key me-2"></i>
                    Change Password
                </h1>
                <a href="<?= url('/users/profile') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Profile
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-lock me-2"></i>
                        Update Your Password
                    </h5>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="<?= url('/users/change-password') ?>" id="changePasswordForm">
                        <input type="hidden" name="csrf_token" value="<?= $this->session->getCsrfToken() ?>">
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label text-light">
                                <i class="fas fa-key me-2"></i>Current Password
                            </label>
                            <input type="password" 
                                   class="form-control bg-dark text-light border-secondary" 
                                   id="current_password" 
                                   name="current_password" 
                                   required
                                   placeholder="Enter your current password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label text-light">
                                <i class="fas fa-lock me-2"></i>New Password
                            </label>
                            <input type="password" 
                                   class="form-control bg-dark text-light border-secondary" 
                                   id="new_password" 
                                   name="new_password" 
                                   required
                                   minlength="6"
                                   placeholder="Enter new password (minimum 6 characters)">
                            <small class="text-muted">Password must be at least 6 characters long</small>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label text-light">
                                <i class="fas fa-check-circle me-2"></i>Confirm New Password
                            </label>
                            <input type="password" 
                                   class="form-control bg-dark text-light border-secondary" 
                                   id="confirm_password" 
                                   name="confirm_password" 
                                   required
                                   minlength="6"
                                   placeholder="Confirm your new password">
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>
                                Update Password
                            </button>
                            <a href="<?= url('/users/profile') ?>" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Tips -->
            <div class="card bg-dark border-info mt-4">
                <div class="card-header bg-info text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Password Security Tips
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="text-light mb-0">
                        <li>Use at least 8 characters (6 minimum required)</li>
                        <li>Include uppercase and lowercase letters</li>
                        <li>Add numbers and special characters</li>
                        <li>Avoid using personal information</li>
                        <li>Don't reuse passwords from other accounts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('New passwords do not match. Please try again.');
        return false;
    }
    
    if (newPassword.length < 6) {
        e.preventDefault();
        alert('Password must be at least 6 characters long.');
        return false;
    }
});

// Show/hide password toggle (optional enhancement)
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
}
</script>

<style>
.form-control:focus {
    border-color: #FFD700;
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
}

.card {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.btn-warning:hover {
    background-color: #e6c200;
    border-color: #e6c200;
}
</style>