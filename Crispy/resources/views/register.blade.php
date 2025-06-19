<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - BurgerDash</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #FF4136;
            --primary-dark: #E60000;
            --primary-light: #FF7675;
            --secondary: #FF851B;
            --accent: #FFDC00;
            --success: #2ECC40;
            --warning: #FF851B;
            --danger: #FF4136;
            --gray-100: #f7fafc;
            --gray-200: #edf2f7;
            --gray-300: #e2e8f0;
            --gray-400: #cbd5e0;
            --gray-500: #a0aec0;
            --gray-600: #718096;
            --gray-700: #4a5568;
            --gray-800: #2d3748;
            --gray-900: #1a202c;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', system-ui, sans-serif; }
        body { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); padding: 2rem; }
        .register-container { width: 100%; max-width: 400px; background: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); overflow: hidden; position: relative; }
        .register-header { text-align: center; padding: 2rem; background: white; position: relative; }
        .register-header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%); }
        .logo { width: 120px; height: 120px; margin-bottom: 1rem; position: relative; }
        .logo svg { width: 100%; height: 100%; }
        .register-form { padding: 2rem; }
        .form-group { margin-bottom: 1.5rem; position: relative; }
        .form-label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--gray-700); font-weight: 500; }
        .form-input { width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 2px solid var(--gray-300); border-radius: 0.5rem; font-size: 1rem; transition: all 0.3s; background: var(--gray-100); }
        .form-input:focus { border-color: var(--primary); background: white; outline: none; box-shadow: 0 0 0 3px rgba(255, 65, 54, 0.1); }
        .form-icon { position: absolute; left: 1rem; top: 2.4rem; color: var(--gray-500); transition: color 0.3s; }
        .form-input:focus + .form-icon { color: var(--primary); }
        .btn { display: block; width: 100%; padding: 0.875rem 1.5rem; font-size: 1rem; font-weight: 600; text-align: center; color: white; background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 4px 6px rgba(255, 65, 54, 0.2); }
        .btn:active { transform: translateY(1px); }
        .btn::after { content: ''; position: absolute; top: 50%; left: 50%; width: 5px; height: 5px; background: rgba(255, 255, 255, 0.5); opacity: 0; border-radius: 100%; transform: scale(1, 1) translate(-50%); transform-origin: 50% 50%; }
        .btn:focus:not(:active)::after { animation: ripple 1s ease-out; }
        @keyframes ripple { 0% { transform: scale(0, 0); opacity: 0.5; } 100% { transform: scale(100, 100); opacity: 0; } }
        .login-link { text-align: center; margin-top: 1rem; }
        .login-link a { color: var(--gray-600); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        .login-link a:hover { color: var(--primary); }
        .register-container { animation: fadeInUp 0.6s ease-out; }
        .form-input.error { border-color: var(--danger); background-color: #fff5f5; }
        .error-message { color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem; display: none; }
        .form-input.error + .form-icon { color: var(--danger); }
        .form-input.error ~ .error-message { display: block; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#FF4136"/>
                    <path d="M30 40 Q50 20 70 40 L70 65 Q50 85 30 65 Z" fill="#FFDC00"/>
                    <circle cx="40" cy="45" r="5" fill="#2ECC40"/>
                    <circle cx="60" cy="45" r="5" fill="#2ECC40"/>
                </svg>
            </div>
            <h1 style="color: var(--gray-800); font-size: 1.875rem; margin-bottom: 0.5rem;">Créer un compte</h1>
            <p style="color: var(--gray-600); font-size: 1rem;">Remplissez le formulaire pour vous inscrire</p>
        </div>
        <form class="register-form" id="registerForm" method="POST" action="{{ url('/register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Nom complet</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Votre nom" required>
                <i class="fas fa-user form-icon"></i>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="votre@email.com" required>
                <i class="fas fa-envelope form-icon"></i>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
                <i class="fas fa-lock form-icon"></i>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-user-plus" style="margin-right: 0.5rem;"></i>
                S'inscrire
            </button>
            <div class="login-link">
                <a href="{{ url('/login') }}">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </div>
</body>
</html> 