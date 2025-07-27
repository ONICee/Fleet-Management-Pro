<?php
$hideNav = true;
$pageTitle = 'Login - State Fleet Management System';

ob_start();
?>

<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%); position: relative;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1; background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23FFD700" fill-opacity="0.3"><polygon points="60,60 30,60 30,30 60,30"/></g></g></svg>');"></div>
    
    <!-- Login Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <!-- Logo and Header -->
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <i class="fas fa-shield-alt" style="font-size: 4rem; color: #FFD700; text-shadow: 0 0 20px rgba(255, 215, 0, 0.5);"></i>
                    </div>
                    <h1 class="h2 mb-2" style="color: #FFD700; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">
                        State Fleet Management
                    </h1>
                    <p class="text-muted mb-4">
                        <i class="fas fa-truck me-2"></i>
                        Secure Access Portal for Government Vehicle Operations
                    </p>
                </div>

                <!-- Login Card -->
                <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #2d2d2d 0%, #404040 100%); border: 2px solid #FFD700 !important; border-radius: 20px;">
                    <div class="card-header text-center border-0" style="background: linear-gradient(90deg, #FFD700, #DAA520); color: #1a1a1a; border-radius: 18px 18px 0 0;">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-lock me-2"></i>
                            Authorized Access Only
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Login Form -->
                        <form method="POST" action="<?= url('/login') ?>" id="loginForm">
                            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                            
                            <div class="mb-4">
                                <label for="username" class="form-label text-light fw-semibold">
                                    <i class="fas fa-user me-2 text-warning"></i>Username
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="username" 
                                       name="username" 
                                       placeholder="Enter your username"
                                       autocomplete="username"
                                       required
                                       style="background: rgba(26, 26, 26, 0.8); border: 2px solid #404040; color: #f8f9fa; border-radius: 15px; padding: 15px 20px;">
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label text-light fw-semibold">
                                    <i class="fas fa-key me-2 text-warning"></i>Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           autocomplete="current-password"
                                           required
                                           style="background: rgba(26, 26, 26, 0.8); border: 2px solid #404040; color: #f8f9fa; border-radius: 15px; padding: 15px 20px; padding-right: 50px;">
                                    <button type="button" 
                                            class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-warning" 
                                            onclick="togglePassword()"
                                            style="border: none; background: none; z-index: 10;">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Security Features Notice -->
                            <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(45deg, rgba(23, 162, 184, 0.2), rgba(23, 162, 184, 0.1)); border-left: 4px solid #17a2b8 !important; border-radius: 10px;">
                                <small>
                                    <i class="fas fa-shield-alt me-2"></i>
                                    All activities are logged and monitored for security purposes.
                                </small>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" 
                                        class="btn btn-lg fw-bold" 
                                        style="background: linear-gradient(45deg, #FFD700, #DAA520); border: none; color: #1a1a1a; border-radius: 25px; padding: 15px; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(255, 215, 0, 0.4)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(255, 215, 0, 0.3)'">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Access System
                                </button>
                            </div>
                        </form>
                        
                        <!-- Help Section -->
                        <div class="text-center mt-4">
                            <p class="mb-2 text-muted small">
                                <i class="fas fa-question-circle me-1"></i>
                                Need assistance accessing your account?
                            </p>
                            <a href="mailto:support@statefleet.gov" class="text-warning text-decoration-none small">
                                <i class="fas fa-envelope me-1"></i>
                                Contact System Administrator
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="text-center mt-4">
                    <div class="row text-muted small">
                        <div class="col-4">
                            <i class="fas fa-database d-block mb-1 text-warning"></i>
                            <span>Secure Database</span>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-lock d-block mb-1 text-warning"></i>
                            <span>Encrypted</span>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-clock d-block mb-1 text-warning"></i>
                            <span>24/7 Monitoring</span>
                        </div>
                    </div>
                </div>

                <!-- Default Credentials Info (Remove in production) -->
                <?php if (defined('DEBUG') && DEBUG): ?>
                <div class="card mt-4 border-warning bg-dark">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Development Mode - Default Credentials</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-sm">
                            <div class="col-6">
                                <strong>Super Admin:</strong><br>
                                <code>superadmin / password</code>
                            </div>
                            <div class="col-6">
                                <strong>Admin:</strong><br>
                                <code>admin / password</code>
                            </div>
                        </div>
                        <div class="row mt-2 text-sm">
                            <div class="col-6">
                                <strong>Data Entry:</strong><br>
                                <code>dataentry / password</code>
                            </div>
                            <div class="col-6">
                                <strong>Guest:</strong><br>
                                <code>guest / password</code>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Footer -->
                <div class="text-center mt-5">
                    <p class="text-muted small mb-2">
                        <i class="fas fa-copyright me-1"></i>
                        <?= date('Y') ?> State Government. All rights reserved.
                    </p>
                    <p class="text-muted small">
                        Fleet Management System v<?= APP_VERSION ?? '1.0.0' ?> | 
                        <span class="text-warning">Enterprise Grade Security</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Add loading state to form submission
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Authenticating...';
        submitBtn.disabled = true;
        
        // Re-enable button after 3 seconds in case of error
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });

    // Focus on username field
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('username').focus();
    });

    // Add floating animation to background elements
    function createFloatingElements() {
        const container = document.querySelector('.min-vh-100');
        
        for (let i = 0; i < 10; i++) {
            const element = document.createElement('div');
            element.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: #FFD700;
                border-radius: 50%;
                opacity: 0.3;
                animation: float ${5 + Math.random() * 10}s linear infinite;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                box-shadow: 0 0 10px #FFD700;
            `;
            container.appendChild(element);
        }
    }

    // Add CSS animation for floating elements
    const style = document.createElement('style');
    style.textContent = `
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    `;
    document.head.appendChild(style);

    // Initialize floating elements
    createFloatingElements();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>