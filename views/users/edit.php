<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-edit me-2"></i>
                    <?= $isOwnProfile ? 'Edit My Profile' : 'Edit User' ?>
                </h1>
                <a href="<?= $isOwnProfile ? url('/users/profile') : url('/users') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-arrow-left me-2"></i>
                    <?= $isOwnProfile ? 'Back to Profile' : 'Back to Users' ?>
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
                    <form method="POST" action="<?= url('/users/edit/' . $user['id']) ?>" id="userEditForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label text-light">
                                    <i class="fas fa-user me-1"></i>First Name *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="first_name" name="first_name" required
                                       value="<?= htmlspecialchars($user['first_name']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label text-light">
                                    <i class="fas fa-user me-1"></i>Last Name *
                                </label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" 
                                       id="last_name" name="last_name" required
                                       value="<?= htmlspecialchars($user['last_name']) ?>">
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
                                       value="<?= htmlspecialchars($user['username']) ?>"
                                       <?= $isOwnProfile ? '' : '' ?>>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-light">
                                    <i class="fas fa-envelope me-1"></i>Email Address *
                                </label>
                                <input type="email" class="form-control bg-dark text-light border-secondary" 
                                       id="email" name="email" required
                                       value="<?= htmlspecialchars($user['email']) ?>">
                            </div>
                        </div>

                        <!-- Password (Optional) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-light">
                                    <i class="fas fa-lock me-1"></i>New Password
                                </label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" 
                                       id="password" name="password"
                                       placeholder="Leave blank to keep current password">
                                <small class="text-muted">Leave blank to keep current password</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label text-light">
                                    <i class="fas fa-lock me-1"></i>Confirm New Password
                                </label>
                                <input type="password" class="form-control bg-dark text-light border-secondary" 
                                       id="confirm_password" name="confirm_password"
                                       placeholder="Confirm new password">
                            </div>
                        </div>

                        <!-- Role and Status (Only for Super Admin or Admin editing others) -->
                        <?php if (!$isOwnProfile && in_array($this->getUserRole(), ['super_admin', 'admin'])): ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label text-light">
                                    <i class="fas fa-user-tag me-1"></i>User Role *
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="role" name="role" required>
                                    <option value="guest" <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest (View Only)</option>
                                    <option value="data_entry_officer" <?= $user['role'] === 'data_entry_officer' ? 'selected' : '' ?>>Data Entry Officer</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrator</option>
                                    <?php if ($this->getUserRole() === 'super_admin'): ?>
                                        <option value="super_admin" <?= $user['role'] === 'super_admin' ? 'selected' : '' ?>>Super Administrator</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label text-light">
                                    <i class="fas fa-signal me-1"></i>Account Status
                                </label>
                                <select class="form-control bg-dark text-light border-secondary" 
                                        id="status" name="status">
                                    <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="suspended" <?= $user['status'] === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Contact Information -->
                        <div class="mb-3">
                            <label for="phone" class="form-label text-light">
                                <i class="fas fa-phone me-1"></i>Phone Number
                            </label>
                            <input type="tel" class="form-control bg-dark text-light border-secondary" 
                                   id="phone" name="phone"
                                   value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                                   placeholder="e.g., +234-802-123-4567">
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-2"></i>
                                Update <?= $isOwnProfile ? 'Profile' : 'User' ?>
                            </button>
                            <a href="<?= $isOwnProfile ? url('/users/profile') : url('/users') ?>" class="btn btn-outline-secondary px-4">
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
                        Update Instructions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <h6 class="text-warning mb-3">Password Security</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Leave password blank to keep current</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use strong passwords (min. 6 characters)</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Passwords must match to update</li>
                        </ul>

                        <?php if (!$isOwnProfile): ?>
                        <h6 class="text-warning mb-3 mt-4">Role Management</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-shield-alt text-info me-2"></i>Super Admin: Full access</li>
                            <li class="mb-2"><i class="fas fa-user-shield text-warning me-2"></i>Admin: Fleet management</li>
                            <li class="mb-2"><i class="fas fa-user-edit text-info me-2"></i>Data Entry: Add/edit data</li>
                            <li class="mb-2"><i class="fas fa-eye text-secondary me-2"></i>Guest: View only</li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($isOwnProfile): ?>
            <div class="card bg-dark border-success mt-3">
                <div class="card-header bg-success text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-user-check me-2"></i>
                        Your Access Level
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <?php 
                        $roleClass = match($user['role']) {
                            'super_admin' => 'bg-danger',
                            'admin' => 'bg-warning text-dark',
                            'data_entry_officer' => 'bg-info',
                            'guest' => 'bg-secondary',
                            default => 'bg-secondary'
                        };
                        ?>
                        <span class="badge <?= $roleClass ?> fs-5 mb-3">
                            <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                        </span>
                        <p class="text-light">You cannot change your own role. Contact a Super Administrator for role changes.</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('userEditForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password && password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
        document.getElementById('confirm_password').focus();
        return;
    }
    
    const requiredFields = ['first_name', 'last_name', 'username', 'email'];
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