<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | State Fleet Management System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            background: linear-gradient(45deg, #FFD700, #DAA520);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
            margin-bottom: 1rem;
        }
        
        .error-icon {
            font-size: 4rem;
            color: #FFD700;
            margin-bottom: 2rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .btn-home {
            background: linear-gradient(45deg, #FFD700, #DAA520);
            border: none;
            color: #1a1a1a;
            font-weight: bold;
            border-radius: 25px;
            padding: 12px 30px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }
        
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
            color: #1a1a1a;
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape" style="left: 10%; width: 80px; height: 80px; animation-delay: 0s;"></div>
        <div class="shape" style="left: 20%; width: 60px; height: 60px; animation-delay: 2s;"></div>
        <div class="shape" style="left: 30%; width: 100px; height: 100px; animation-delay: 4s;"></div>
        <div class="shape" style="left: 40%; width: 40px; height: 40px; animation-delay: 6s;"></div>
        <div class="shape" style="left: 50%; width: 120px; height: 120px; animation-delay: 8s;"></div>
        <div class="shape" style="left: 60%; width: 70px; height: 70px; animation-delay: 10s;"></div>
        <div class="shape" style="left: 70%; width: 90px; height: 90px; animation-delay: 12s;"></div>
        <div class="shape" style="left: 80%; width: 50px; height: 50px; animation-delay: 14s;"></div>
        <div class="shape" style="left: 90%; width: 110px; height: 110px; animation-delay: 16s;"></div>
    </div>

    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-route"></i>
        </div>
        
        <div class="error-code">404</div>
        
        <h1 class="mb-4" style="color: #FFD700;">Route Not Found</h1>
        
        <p class="lead mb-4 text-muted">
            The requested page or resource could not be located in our fleet management system.
        </p>
        
        <p class="mb-5">
            <i class="fas fa-map-marked-alt me-2 text-warning"></i>
            You may have followed an invalid link or the page may have been moved to a new location.
        </p>
        
        <div class="d-flex gap-3 justify-content-center flex-wrap">
                                <a href="<?= url('/') ?>" class="btn btn-home">
                <i class="fas fa-home me-2"></i>
                Return to Dashboard
            </a>
            
            <button onclick="history.back()" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Go Back
            </button>
        </div>
        
        <div class="mt-5 pt-4 border-top border-secondary">
            <p class="text-muted small mb-2">
                <i class="fas fa-shield-alt me-1"></i>
                State Fleet Management System
            </p>
            <p class="text-muted small">
                If you believe this is an error, please contact your system administrator.
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>