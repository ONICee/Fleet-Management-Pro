<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-user-plus me-2"></i>
                    Create New User
                </h1>
                <a href="<?= url('/users') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Users
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        User Information
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= url('/users/create') ?>" id="userForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label text-light">
                                    <i class="fas fa-user me-1"></i>First Name *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="first_name" name="first_name" required
                                       placeholder="Enter first name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label text-light">
                                    <i class="fas fa-user me-1"></i>Last Name *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="last_name" name="last_name" required
                                       placeholder="Enter last name">
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label text-light">
                                    <i class="fas fa-at me-1"></i>Username *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="username" name="username" required
                                       placeholder="Enter username (unique)">
                                <small class="text-muted">Must be unique and contain only letters, numbers, and underscores</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-light">
                                    <i class="fas fa-envelope me-1"></i>Email Address *
                                </label>
                                <input type="email" class="form-control bg-dark text-light border-secondary" 
                                       id="email" name="email" required
                                       placeholder="Enter email address">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-light">
                                    <i class="fas fa-lock me-1"></i>Password *
                                </label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" 
                                       id="password" name="password" required minlength="6"
                                       placeholder="Enter password (min. 6 characters)">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label text-light">
                                    <i class="fas fa-lock me-1"></i>Confirm Password *
                                </label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" 
                                       id="confirm_password" name="confirm_password" required minlength="6"
                                       placeholder="Confirm password">
                            </div>
                        </div>

                        <!-- Role and Status -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label text-light">
                                    <i class="fas fa-user-tag me-1"></i>User Role *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="guest">Guest (View Only)</option>
                                    <option value="data_entry_officer">Data Entry Officer</option>
                                    <option value="admin">Administrator</option>
                                    <?php if ($userRole === 'super_admin'): ?>
                                        <option value="super_admin">Super Administrator</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label text-light">
                                    <i class="fas fa-signal me-1"></i>Account Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="status" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-3">
                            <label for="phone" class="form-label text-light">
                                <i class="fas fa-phone me-1"></i>Phone Number
                            </label>
                            <input type="tel" class="form-control bg-dark text-light border-secondary" 
                                   id="phone" name="phone"
                                   placeholder="e.g., +234-802-123-4567">
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>
                                Create User
                            </button>
                            <a href="<?= url('/users') ?>" class="btn btn-outline-secondary px-4">
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
                        <i class="fas fa-shield-alt me-2"></i>
                        User Roles Guide
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <div class="mb-3">
                            <h6 class="text-danger mb-2">
                                <i class="fas fa-crown me-1"></i>Super Administrator
                            </h6>
                            <ul class="list-unstyled small">
                                <li><i class="fas fa-check text-success me-1"></i>Full system access</li>
                                <li><i class="fas fa-check text-success me-1"></i>User management</li>
                                <li><i class="fas fa-check text-success me-1"></i>System logs access</li>
                                <li><i class="fas fa-check text-success me-1"></i>All reports and analytics</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-warning mb-2">
                                <i class="fas fa-user-shield me-1"></i>Administrator
                            </h6>
                            <ul class="list-unstyled small">
                                <li><i class="fas fa-check text-success me-1"></i>Fleet management</li>
                                <li><i class="fas fa-check text-success me-1"></i>Reports and analytics</li>
                                <li><i class="fas fa-check text-success me-1"></i>User oversight</li>
                                <li><i class="fas fa-times text-danger me-1"></i>No user creation/deletion</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-info mb-2">
                                <i class="fas fa-user-edit me-1"></i>Data Entry Officer
                            </h6>
                            <ul class="list-unstyled small">
                                <li><i class="fas fa-check text-success me-1"></i>Add/edit vehicles</li>
                                <li><i class="fas fa-check text-success me-1"></i>Maintenance records</li>
                                <li><i class="fas fa-check text-success me-1"></i>Fuel records</li>
                                <li><i class="fas fa-times text-danger me-1"></i>No reports access</li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-secondary mb-2">
                                <i class="fas fa-eye me-1"></i>Guest
                            </h6>
                            <ul class="list-unstyled small">
                                <li><i class="fas fa-check text-success me-1"></i>View-only access</li>
                                <li><i class="fas fa-check text-success me-1"></i>Basic fleet information</li>
                                <li><i class="fas fa-times text-danger me-1"></i>No data modification</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-dark border-warning mt-3">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Security Notes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-key text-warning me-2"></i>
                                <small>Use strong passwords (min. 6 characters)</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-user-lock text-warning me-2"></i>
                                <small>Assign the lowest role necessary</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-history text-warning me-2"></i>
                                <small>All user activities are logged</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-envelope text-warning me-2"></i>
                                <small>Email addresses must be unique</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('userForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
        document.getElementById('confirm_password').focus();
        return;
    }
    
    const requiredFields = ['first_name', 'last_name', 'username', 'email', 'password', 'role'];
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

// Real-time password confirmation check
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Remove invalid class on input
document.querySelectorAll('input, select').forEach(function(element) {
    element.addEventListener('input', function() {
        if (this.id !== 'confirm_password') {
            this.classList.remove('is-invalid');
        }
    });
});
</script>