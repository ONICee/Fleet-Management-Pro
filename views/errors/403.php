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
    <title>403 - Access Forbidden</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gold: #FFD700;
            --dark-gold: #DAA520;
            --primary-black: #1a1a1a;
            --secondary-black: #2d2d2d;
            --text-light: #f8f9fa;
        }

        body {
            background: linear-gradient(135deg, var(--primary-black) 0%, var(--secondary-black) 100%);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
        }

        .error-code {
            font-size: 8rem;
            font-weight: bold;
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 2.5rem;
            color: var(--primary-gold);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .error-description {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-home {
            background: linear-gradient(45deg, var(--primary-gold), var(--dark-gold));
            border: none;
            color: var(--primary-black);
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
            color: var(--primary-black);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            font-weight: bold;
            padding: 10px 28px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .btn-secondary:hover {
            background: var(--primary-gold);
            color: var(--primary-black);
        }

        .icon-lock {
            font-size: 4rem;
            color: var(--primary-gold);
            margin-bottom: 30px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .security-note {
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid var(--primary-gold);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }

        .security-note h5 {
            color: var(--primary-gold);
            margin-bottom: 15px;
        }

        .security-note ul {
            text-align: left;
            list-style: none;
            padding: 0;
        }

        .security-note li {
            margin-bottom: 8px;
            color: var(--text-light);
        }

        .security-note i {
            color: var(--primary-gold);
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 5rem;
            }
            
            .error-title {
                font-size: 2rem;
            }
            
            .error-description {
                font-size: 1rem;
            }
            
            .error-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <!-- Lock Icon -->
        <div class="icon-lock">
            <i class="fas fa-lock"></i>
        </div>
        
        <!-- Error Code -->
        <div class="error-code">403</div>
        
        <!-- Error Title -->
        <h1 class="error-title">Access Forbidden</h1>
        
        <!-- Error Description -->
        <p class="error-description">
            You don't have permission to access this resource. This area is restricted to authorized personnel only.
        </p>
        
        <!-- Action Buttons -->
        <div>
            <a href="<?= url('/') ?>" class="btn-home">
                <i class="fas fa-home me-2"></i>
                Return to Dashboard
            </a>
            
            <a href="<?= url('/login') ?>" class="btn-secondary">
                <i class="fas fa-sign-in-alt me-2"></i>
                Login with Different Account
            </a>
        </div>
        
        <!-- Security Information -->
        <div class="security-note">
            <h5>
                <i class="fas fa-shield-alt me-2"></i>
                Security Information
            </h5>
            <ul>
                <li>
                    <i class="fas fa-check"></i>
                    This system uses role-based access control
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    All access attempts are logged for security
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Contact your administrator for access requests
                </li>
                <li>
                    <i class="fas fa-check"></i>
                    Unauthorized access attempts will be reported
                </li>
            </ul>
        </div>
        
        <!-- System Info -->
        <div class="mt-4">
            <small class="text-light">
                <i class="fas fa-shield-alt me-1 text-warning"></i>
                State Fleet Management System - Secure Access
            </small>
        </div>
    </div>
</body>
</html>