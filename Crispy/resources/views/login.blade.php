<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - BurgerDash</title>
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
        .login-container { width: 100%; max-width: 400px; background: white; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); overflow: hidden; position: relative; }
        .login-header { text-align: center; padding: 2rem; background: white; position: relative; }
        .login-header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%); }
        .logo { width: 120px; height: 120px; margin-bottom: 1rem; position: relative; }
        .logo svg { width: 100%; height: 100%; }
        .login-form { padding: 2rem; }
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
        .remember-me { display: flex; align-items: center; margin-bottom: 1.5rem; cursor: pointer; }
        .remember-me input { position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; }
        .checkmark { height: 20px; width: 20px; background-color: var(--gray-200); border-radius: 4px; margin-right: 0.5rem; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
        .remember-me:hover input ~ .checkmark { background-color: var(--gray-300); }
        .remember-me input:checked ~ .checkmark { background-color: var(--primary); }
        .checkmark:after { content: ''; display: none; width: 5px; height: 10px; border: solid white; border-width: 0 2px 2px 0; transform: rotate(45deg); }
        .remember-me input:checked ~ .checkmark:after { display: block; }
        .forgot-password { text-align: center; margin-top: 1rem; }
        .forgot-password a { color: var(--gray-600); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        .forgot-password a:hover { color: var(--primary); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .login-container { animation: fadeInUp 0.6s ease-out; }
        .form-input.error { border-color: var(--danger); background-color: #fff5f5; }
        .error-message { color: var(--danger); font-size: 0.875rem; margin-top: 0.5rem; display: none; }
        .form-input.error + .form-icon { color: var(--danger); }
        .form-input.error ~ .error-message { display: block; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="#FF4136"/>
                    <path d="M30 40 Q50 20 70 40 L70 65 Q50 85 30 65 Z" fill="#FFDC00"/>
                    <circle cx="40" cy="45" r="5" fill="#2ECC40"/>
                    <circle cx="60" cy="45" r="5" fill="#2ECC40"/>
                </svg>
            </div>
            <h1 style="color: var(--gray-800); font-size: 1.875rem; margin-bottom: 0.5rem;">BurgerDash</h1>
            <p style="color: var(--gray-600); font-size: 1rem;">Connectez-vous à votre compte</p>
        </div>
        <form class="login-form" id="loginForm">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" class="form-input" placeholder="votre@email.com" required>
                <i class="fas fa-envelope form-icon"></i>
                <div class="error-message">Veuillez entrer une adresse email valide</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <input type="password" id="password" class="form-input" placeholder="••••••••" required>
                <i class="fas fa-lock form-icon"></i>
                <div class="error-message">Le mot de passe est requis</div>
            </div>
            <label class="remember-me">
                <input type="checkbox">
                <span class="checkmark"></span>
                Se souvenir de moi
            </label>
            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
                Se connecter
            </button>
            <a href="{{ url('/register') }}" class="btn" style="margin-top: 1rem; background: var(--secondary); color: white;">S'inscrire</a>
            <div class="forgot-password">
                <a href="#">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let isValid = true;
            // Email validation
            if (!email.value || !email.value.includes('@')) {
                email.classList.add('error');
                isValid = false;
            } else {
                email.classList.remove('error');
            }
            // Password validation
            if (!password.value || password.value.length < 6) {
                password.classList.add('error');
                isValid = false;
            } else {
                password.classList.remove('error');
            }
            if (isValid) {
                // Simulate login - Replace with actual login logic
                const btn = this.querySelector('.btn');
                btn.style.pointerEvents = 'none';
                btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Connexion...';
                setTimeout(() => {
                    window.location.href = "{{ url('/dashboard') }}";
                }, 1500);
            }
        });
        // Show/hide password
        document.getElementById('password').addEventListener('input', function() {
            const btn = document.querySelector('.btn');
            if (this.value && document.getElementById('email').value) {
                btn.removeAttribute('disabled');
            } else {
                btn.setAttribute('disabled', 'disabled');
            }
        });
    </script>
</body>
</html> 