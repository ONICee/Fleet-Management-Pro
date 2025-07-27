<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-warning">
                    <i class="fas fa-building me-2"></i>
                    Agency Management
                </h1>
            </div>
        </div>
    </div>

    <!-- Agencies Table -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-dark border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Security & Related Agencies
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (empty($agencies)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Agencies Found</h4>
                            <p class="text-muted">Agency data will be displayed here.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>S/N</th>
                                        <th><i class="fas fa-building me-1"></i>Agency Name</th>
                                        <th><i class="fas fa-code me-1"></i>Code</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Type</th>
                                        <th><i class="fas fa-user-tie me-1"></i>Contact Person</th>
                                        <th><i class="fas fa-phone me-1"></i>Phone</th>
                                        <th><i class="fas fa-car me-1"></i>Vehicles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($agencies as $index => $agency): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong class="text-warning"><?= htmlspecialchars($agency['agency_name']) ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($agency['agency_code']) ?></span>
                                            </td>
                                            <td>
                                                <?php 
                                                $typeClass = match($agency['agency_type']) {
                                                    'federal' => 'bg-info',
                                                    'state' => 'bg-warning text-dark',
                                                    'local' => 'bg-success',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $typeClass ?>">
                                                    <?= ucfirst($agency['agency_type']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-light"><?= htmlspecialchars($agency['contact_person'] ?? 'N/A') ?></span>
                                            </td>
                                            <td>
                                                <span class="text-muted"><?= htmlspecialchars($agency['contact_phone'] ?? 'N/A') ?></span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?= $agency['vehicle_count'] ?? 0 ?> vehicles</span>
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