<?php
// Ensure helpers are available
if (!function_exists('url')) {
    require_once __DIR__ . '/../../core/helpers.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'State Fleet Management System' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-gold: #FFD700;
            --dark-gold: #DAA520;
            --light-gold: #FFF8DC;
            --primary-black: #1a1a1a;
            --secondary-black: #2d2d2d;
            --light-black: #404040;
            --text-light: #f8f9fa;
            --text-muted: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }

        body {
            background: linear-gradient(135deg, var(--primary-black) 0%, var(--secondary-black) 100%);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .content-wrapper {
            display: flex;
            flex: 1;
        }

        .navbar {
            background: linear-gradient(90deg, var(--primary-black) 0%, var(--secondary-black) 100%);
            border-bottom: 2px solid var(--primary-gold);
            box-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .navbar-brand {
            color: var(--primary-gold) !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: var(--text-light) !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-gold) !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-gold) !important;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--secondary-black) 0%, var(--primary-black) 100%);
            height: calc(100vh - 76px);
            border-right: 1px solid var(--light-black);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 76px;
            left: 0;
            width: 250px;
            overflow-y: auto;
            z-index: 1020;
        }

        .sidebar .nav-link {
            color: var(--text-light);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 4px 8px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            color: var(--primary-black);
            transform: translateX(5px);
            border-color: var(--primary-gold);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            color: var(--primary-black);
            font-weight: bold;
        }

        .main-content {
            background: rgba(26, 26, 26, 0.95);
            height: calc(100vh - 136px);
            border-radius: 15px 0 0 0;
            margin-left: 250px;
            margin-top: 76px;
            overflow-y: auto;
            padding: 20px;
        }

        .card {
            background: linear-gradient(135deg, var(--secondary-black) 0%, var(--light-black) 100%);
            border: 1px solid var(--primary-gold);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 215, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
            color: var(--primary-black);
            font-weight: bold;
            border-radius: 14px 14px 0 0 !important;
            border-bottom: none;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            border: none;
            color: var(--primary-black);
            font-weight: bold;
            border-radius: 25px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, var(--dark-gold), var(--primary-gold));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            background: transparent;
            border-radius: 25px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-gold);
            color: var(--primary-black);
            transform: translateY(-2px);
        }

        .form-control {
            background: rgba(45, 45, 45, 0.8);
            border: 1px solid var(--light-black);
            color: var(--text-light);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(45, 45, 45, 1);
            border-color: var(--primary-gold);
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
            color: var(--text-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .table-dark {
            background: var(--secondary-black);
            border-color: var(--light-black);
        }

        .table-dark th {
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
            color: var(--primary-black);
            border-color: var(--primary-gold);
        }

        .table-dark td {
            border-color: var(--light-black);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: linear-gradient(45deg, rgba(40, 167, 69, 0.2), rgba(40, 167, 69, 0.1));
            border-left: 4px solid var(--success);
            color: var(--text-light);
        }

        .alert-danger {
            background: linear-gradient(45deg, rgba(220, 53, 69, 0.2), rgba(220, 53, 69, 0.1));
            border-left: 4px solid var(--danger);
            color: var(--text-light);
        }

        .alert-warning {
            background: linear-gradient(45deg, rgba(255, 193, 7, 0.2), rgba(255, 193, 7, 0.1));
            border-left: 4px solid var(--warning);
            color: var(--text-light);
        }

        .alert-info {
            background: linear-gradient(45deg, rgba(23, 162, 184, 0.2), rgba(23, 162, 184, 0.1));
            border-left: 4px solid var(--info);
            color: var(--text-light);
        }

        .stats-card {
            background: linear-gradient(135deg, var(--secondary-black), var(--light-black));
            border-left: 4px solid var(--primary-gold);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            background: linear-gradient(135deg, var(--light-black), var(--secondary-black));
            border-left-width: 6px;
        }

        .notification-badge {
            background: linear-gradient(45deg, var(--danger), #ff6b6b);
            border: 2px solid var(--primary-black);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .footer {
            background: linear-gradient(90deg, var(--primary-black), var(--secondary-black));
            border-top: 1px solid var(--primary-gold);
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            z-index: 1010;
            height: 60px;
        }

        .flash-messages-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .flash-alert {
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: none;
            font-weight: 500;
        }

        .flash-alert.alert-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            border-left: 4px solid #fff;
            color: white;
        }

        .flash-alert.alert-error,
        .flash-alert.alert-danger {
            background: linear-gradient(45deg, #dc3545, #e74c3c);
            border-left: 4px solid #fff;
            color: white;
        }

        .flash-alert.alert-warning {
            background: linear-gradient(45deg, #ffc107, #ffb300);
            border-left: 4px solid #fff;
            color: #212529;
        }

        .flash-alert.alert-info {
            background: linear-gradient(45deg, #17a2b8, #138496);
            border-left: 4px solid #fff;
            color: white;
        }

        .text-gold {
            color: var(--primary-gold) !important;
        }

        .bg-gold {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold)) !important;
            color: var(--primary-black) !important;
        }

        .border-gold {
            border-color: var(--primary-gold) !important;
        }

        /* Loading spinner */
        .spinner-gold {
            border: 3px solid rgba(255, 215, 0, 0.3);
            border-top: 3px solid var(--primary-gold);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }
            .main-content {
                margin-top: 20px;
                border-radius: 15px;
            }
        }
    </style>
    
    <?= $additionalCSS ?? '' ?>
</head>
<body>
    <!-- Navigation -->
    <?php if (isset($user) && $user): ?>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
                            <a class="navbar-brand" href="<?= url('/dashboard') ?>">
                <i class="fas fa-truck me-2"></i>
                <?= APP_NAME ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                        </a>
                    </li>
                    <?php if ($userRole !== 'guest'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/vehicles') ?>">
                            <i class="fas fa-car me-1"></i> Vehicles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/maintenance') ?>">
                            <i class="fas fa-wrench me-1"></i> Maintenance
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (in_array($userRole, ['super_admin', 'admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('/reports') ?>">
                            <i class="fas fa-chart-bar me-1"></i> Reports
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="badge notification-badge rounded-pill position-absolute top-0 start-100 translate-middle" id="notificationCount" style="font-size: 0.7rem;">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--secondary-black); border: 1px solid var(--primary-gold);">
                            <li><h6 class="dropdown-header text-gold">Notifications</h6></li>
                            <li><hr class="dropdown-divider" style="border-color: var(--light-black);"></li>
                            <div id="notificationList">
                                <li><span class="dropdown-item-text text-muted">No new notifications</span></li>
                            </div>
                            <li><hr class="dropdown-divider" style="border-color: var(--light-black);"></li>
                            <li><a class="dropdown-item text-light" href="<?= url('/notifications') ?>">View All</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--secondary-black); border: 1px solid var(--primary-gold);">
                            <li><span class="dropdown-header text-gold"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $userRole))) ?></span></li>
                            <li><hr class="dropdown-divider" style="border-color: var(--light-black);"></li>
                            <li><a class="dropdown-item text-light" href="<?= url('/users/profile') ?>"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <?php if ($userRole === 'super_admin'): ?>
                            <li><a class="dropdown-item text-light" href="<?= url('/users') ?>"><i class="fas fa-users me-2"></i>Manage Users</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider" style="border-color: var(--light-black);"></li>
                            <li><a class="dropdown-item text-light" href="<?= url('/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Flash Messages -->
    <?php if (!empty($flashMessages)): ?>
        <div class="flash-messages-container">
            <?php foreach ($flashMessages as $message): ?>
                <div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show flash-alert" role="alert">
                    <?php
                    $icon = [
                        'success' => 'fas fa-check-circle',
                        'error' => 'fas fa-exclamation-triangle',
                        'warning' => 'fas fa-exclamation-circle',
                        'info' => 'fas fa-info-circle'
                    ][$message['type']] ?? 'fas fa-info-circle';
                    ?>
                    <i class="<?= $icon ?> me-2"></i>
                    <?= htmlspecialchars($message['message']) ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Main Content Wrapper -->
    <?php if (isset($user) && $user && !isset($hideNav)): ?>
    <!-- Sidebar -->
    <div class="sidebar">
                    <nav class="nav flex-column py-3">
                        <a class="nav-link" href="<?= url('/dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        
                        <?php if ($userRole !== 'guest'): ?>
                        <a class="nav-link" href="<?= url('/vehicles') ?>">
                            <i class="fas fa-car me-2"></i> Vehicles
                        </a>
                        <a class="nav-link" href="<?= url('/agencies') ?>">
                            <i class="fas fa-building me-2"></i> Agencies
                        </a>
                        <a class="nav-link" href="<?= url('/maintenance') ?>">
                            <i class="fas fa-wrench me-2"></i> Maintenance
                        </a>
                        <a class="nav-link" href="<?= url('/fuel') ?>">
                            <i class="fas fa-gas-pump me-2"></i> Fuel Records
                        </a>
                        <?php endif; ?>
                        
                        <?php if (in_array($userRole, ['super_admin', 'admin'])): ?>
                        <a class="nav-link" href="<?= url('/reports') ?>">
                            <i class="fas fa-chart-bar me-2"></i> Reports
                        </a>
                        <?php endif; ?>
                        
                        <?php if ($userRole === 'super_admin'): ?>
                        <a class="nav-link" href="<?= url('/users') ?>">
                            <i class="fas fa-users me-2"></i> Users
                        </a>
                        <a class="nav-link" href="<?= url('/system-logs') ?>">
                            <i class="fas fa-history me-2"></i> System Logs
                        </a>
                        <a class="nav-link" href="<?= url('/settings') ?>">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                        <?php endif; ?>
                        
                        <a class="nav-link" href="<?= url('/notifications') ?>">
                            <i class="fas fa-bell me-2"></i> Notifications
                        </a>
                    </nav>
                </nav>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-content">
        <?= $content ?>
    </div>
    <?php else: ?>
    <!-- Full width for login and other auth pages -->
    <div class="container-fluid" style="margin-top: 76px;">
        <?= $content ?>
    </div>
    <?php endif; ?>

    <!-- Footer -->
    <?php if (isset($user) && $user): ?>
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0 text-light">
                        <i class="fas fa-copyright me-1 text-warning"></i>
                        <?= date('Y') ?> State Fleet Management System. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0 text-light">
                        Version 1.0.0 | 
                        <span class="text-warning fw-bold">Enterprise Grade</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Load notifications
        function loadNotifications() {
            <?php if (isset($user) && $user): ?>
            fetch('/api/notifications/unread')
                .then(response => response.json())
                .then(data => {
                    const countElement = document.getElementById('notificationCount');
                    const listElement = document.getElementById('notificationList');
                    
                    if (data.count > 0) {
                        countElement.textContent = data.count;
                        countElement.style.display = 'inline';
                        
                        listElement.innerHTML = data.notifications.map(notification => 
                            `<li><a class="dropdown-item text-light" href="<?= url('/notifications') ?>">
                                <small class="text-gold">${notification.type}</small><br>
                                ${notification.title}
                            </a></li>`
                        ).join('');
                    } else {
                        countElement.style.display = 'none';
                        listElement.innerHTML = '<li><span class="dropdown-item-text text-muted">No new notifications</span></li>';
                    }
                })
                .catch(error => console.error('Error loading notifications:', error));
            <?php endif; ?>
        }

        // Load notifications on page load and refresh every 30 seconds
        document.addEventListener('DOMContentLoaded', function() {
            loadNotifications();
            setInterval(loadNotifications, 30000);
        });

        // Set active navigation link
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar .nav-link, .navbar-nav .nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
    <?= $additionalJS ?? '' ?>
</body>
</html>