<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-user me-2"></i>
                    My Profile
                </h1>
                <a href="<?= url('/users/edit/' . $user['id']) ?>" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-user-circle me-2"></i>
                        Profile Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">First Name</label>
                            <div class="text-warning h5"><?= htmlspecialchars($user['first_name']) ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Last Name</label>
                            <div class="text-warning h5"><?= htmlspecialchars($user['last_name']) ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Username</label>
                            <div class="text-info">@<?= htmlspecialchars($user['username']) ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Email Address</label>
                            <div class="text-info"><?= htmlspecialchars($user['email']) ?></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Role</label>
                            <div>
                                <?php 
                                $roleClass = match($user['role']) {
                                    'super_admin' => 'bg-danger',
                                    'admin' => 'bg-warning text-dark',
                                    'data_entry_officer' => 'bg-info',
                                    'guest' => 'bg-secondary',
                                    default => 'bg-secondary'
                                };
                                ?>
                                <span class="badge <?= $roleClass ?> fs-6">
                                    <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Status</label>
                            <div>
                                <?php if ($user['status'] === 'active'): ?>
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-check me-1"></i>Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger fs-6">
                                        <i class="fas fa-times me-1"></i><?= ucfirst($user['status']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($user['phone']): ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Phone Number</label>
                            <div class="text-light"><?= htmlspecialchars($user['phone']) ?></div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Last Login</label>
                            <div class="text-muted">
                                <?php if ($user['last_login']): ?>
                                    <?= date('F j, Y g:i A', strtotime($user['last_login'])) ?>
                                <?php else: ?>
                                    Never
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-light fw-semibold">Account Created</label>
                            <div class="text-muted"><?= date('F j, Y g:i A', strtotime($user['created_at'])) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-dark border-info">
                <div class="card-header bg-info text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-key me-2"></i>
                        Security
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="<?= url('/users/change-password') ?>" class="btn btn-outline-warning w-100">
                            <i class="fas fa-lock me-2"></i>
                            Change Password
                        </a>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>Keep your account secure by using a strong password and changing it regularly.</small>
                    </div>
                </div>
            </div>
            
            <div class="card bg-dark border-success mt-3">
                <div class="card-header bg-success text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        Permissions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-light">
                        <?php
                        $permissions = [];
                        switch($user['role']) {
                            case 'super_admin':
                                $permissions = ['Full System Access', 'User Management', 'System Logs', 'All Reports', 'Data Management'];
                                break;
                            case 'admin':
                                $permissions = ['Fleet Management', 'Reports', 'User Oversight', 'Data Management'];
                                break;
                            case 'data_entry_officer':
                                $permissions = ['Vehicle Entry', 'Maintenance Records', 'Fuel Records'];
                                break;
                            case 'guest':
                                $permissions = ['View Only Access', 'Basic Reports'];
                                break;
                        }
                        ?>
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($permissions as $permission): ?>
                                <li class="mb-1">
                                    <i class="fas fa-check text-success me-2"></i>
                                    <small><?= $permission ?></small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>