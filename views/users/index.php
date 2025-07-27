<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-users me-2"></i>
                    User Management
                </h1>
                <a href="<?= url('/users/create') ?>" class="btn btn-warning">
                    <i class="fas fa-plus me-2"></i>
                    Add New User
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-warning h-100">
                <div class="card-body text-center">
                    <div class="text-warning">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5>Total Users</h5>
                        <h3 class="text-light"><?= $stats['total'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-success h-100">
                <div class="card-body text-center">
                    <div class="text-success">
                        <i class="fas fa-user-check fa-2x mb-2"></i>
                        <h5>Active Users</h5>
                        <h3 class="text-light"><?= $stats['active'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-info h-100">
                <div class="card-body text-center">
                    <div class="text-info">
                        <i class="fas fa-user-shield fa-2x mb-2"></i>
                        <h5>Admins</h5>
                        <h3 class="text-light"><?= $stats['admins'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-dark border-secondary h-100">
                <div class="card-body text-center">
                    <div class="text-light">
                        <i class="fas fa-user-edit fa-2x mb-2"></i>
                        <h5>Data Entry</h5>
                        <h3 class="text-light"><?= $stats['data_entry'] ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        System Users
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($users)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Users Found</h4>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                        <th><i class="fas fa-user me-1"></i>Name</th>
                                        <th><i class="fas fa-at me-1"></i>Email</th>
                                        <th><i class="fas fa-user-tag me-1"></i>Role</th>
                                        <th><i class="fas fa-signal me-1"></i>Status</th>
                                        <th><i class="fas fa-clock me-1"></i>Last Login</th>
                                        <th><i class="fas fa-calendar me-1"></i>Created</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td>
                                                <strong class="text-warning"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></strong><br>
                                                <small class="text-muted">@<?= htmlspecialchars($user['username']) ?></small>
                                            </td>
                                            <td>
                                                <span class="text-info"><?= htmlspecialchars($user['email']) ?></span>
                                            </td>
                                            <td>
                                                <?php 
                                                $roleClass = match($user['role']) {
                                                    'super_admin' => 'bg-danger',
                                                    'admin' => 'bg-warning text-dark',
                                                    'data_entry_officer' => 'bg-info',
                                                    'guest' => 'bg-secondary',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $roleClass ?>">
                                                    <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($user['status'] === 'active'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Active
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times me-1"></i><?= ucfirst($user['status']) ?>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($user['last_login']): ?>
                                                    <small class="text-muted"><?= date('M j, Y g:i A', strtotime($user['last_login'])) ?></small>
                                                <?php else: ?>
                                                    <small class="text-muted">Never</small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted"><?= date('M j, Y', strtotime($user['created_at'])) ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?= url('/users/edit/' . $user['id']) ?>" 
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if ($user['id'] !== $this->getUser()['id']): ?>
                                                        <button type="button" 
                                                                class="btn btn-outline-danger" 
                                                                title="Delete"
                                                                onclick="confirmDelete(<?= $user['id'] ?>, '<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId, userName) {
    if (confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`)) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= url('/users/delete/') ?>' + userId;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = 'csrf_token';
        csrfToken.value = '<?= $csrfToken ?>';
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>