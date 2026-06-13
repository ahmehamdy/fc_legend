{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - FC Dynamo Admin Portal</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #8B0000;
            --primary-dark: #5c0000;
            --primary-light: #b30000;
            --dark-bg: #0A0A0A;
            --dark-card: #111111;
            --dark-border: #1f1f1f;
            --text-gray: #e5e5e5;
            --text-muted: #9ca3af;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1a1a1a 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="%238B0000" d="M10,10 L20,10 L15,20 Z M40,30 L55,30 L47.5,45 Z M70,60 L85,60 L77.5,75 Z M25,70 L35,70 L30,80 Z"/><circle cx="80" cy="20" r="5"/><circle cx="15" cy="85" r="8"/></svg>');
            background-repeat: repeat;
            pointer-events: none;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            border-color: var(--primary);
            box-shadow: 0 25px 50px -12px rgba(139, 0, 0, 0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo h1 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.5rem;
            color: white;
            letter-spacing: 2px;
        }

        .logo h1 span {
            color: var(--primary);
        }

        .logo p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .role-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--dark-border);
            padding-bottom: 0.5rem;
        }

        .role-tab {
            flex: 1;
            text-align: center;
            padding: 0.75rem;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .role-tab i {
            margin-right: 0.5rem;
        }

        .role-tab.active {
            color: var(--primary);
            background: rgba(139, 0, 0, 0.1);
        }

        .role-tab:hover:not(.active) {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group label i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background-color: #1a1a1a;
            border: 1px solid var(--dark-border);
            color: white;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.2);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.85rem;
            cursor: pointer;
        }

        .checkbox-label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .forgot-link {
            color: var(--primary);
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-light);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            border: none;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(139, 0, 0, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #dc3545;
        }

        .alert-success {
            background: rgba(25, 135, 84, 0.15);
            border: 1px solid rgba(25, 135, 84, 0.3);
            color: #198754;
        }

        .alert-info {
            background: rgba(139, 0, 0, 0.15);
            border: 1px solid rgba(139, 0, 0, 0.3);
            color: var(--primary);
        }

        .demo-credentials {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--dark-border);
        }

        .demo-title {
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            margin-bottom: 0.75rem;
        }

        .demo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            font-size: 0.75rem;
        }

        .demo-item {
            background: rgba(255, 255, 255, 0.03);
            padding: 0.5rem;
            border-radius: 6px;
            text-align: center;
        }

        .demo-item strong {
            color: var(--primary);
            display: block;
            margin-bottom: 0.25rem;
        }

        .demo-item span {
            color: var(--text-muted);
            font-family: monospace;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: var(--primary);
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }

            .demo-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <h1>FC <span>DYNAMO</span></h1>
                <p><i class="fas fa-shield-alt"></i> Admin & Journalist Portal</p>
            </div>

            {{-- Error Messages --}}
            @if (session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Role Tabs --}}
            <div class="role-tabs">
                <button class="role-tab active" data-role="admin" onclick="setRole('admin')">
                    <i class="fas fa-user-shield"></i> Admin
                </button>
                <button class="role-tab" data-role="journalist" onclick="setRole('journalist')">
                    <i class="fas fa-pen-fancy"></i> Journalist
                </button>
            </div>

            {{-- Login Form --}}
            <form method="POST" action="{{ route('auth.login') }}" id="loginForm">
                @csrf
                <input type="hidden" name="role" id="selectedRole" value="admin">

                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email"
                            required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <div class="password-wrapper">
                        <i class="fas fa-lock"
                            style="left: 15px; position: absolute; top: 50%; transform: translateY(-50%);"></i>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" required style="padding-left: 45px;">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Sign In
                </button>
            </form>

            {{-- Demo Credentials (for testing only - remove in production) --}}
            <div class="demo-credentials">
                <div class="demo-title">
                    <i class="fas fa-info-circle"></i> Demo Credentials
                </div>
                <div class="demo-grid">
                    <div class="demo-item">
                        <strong><i class="fas fa-user-shield"></i> Admin</strong>
                        <span>admin@fcdynamo.com</span>
                        <span style="display: block; font-size: 0.7rem;">password: admin123</span>
                    </div>
                    <div class="demo-item">
                        <strong><i class="fas fa-pen-fancy"></i> Journalist</strong>
                        <span>journalist@fcdynamo.com</span>
                        <span style="display: block; font-size: 0.7rem;">password: journal123</span>
                    </div>
                </div>
            </div>

            <div class="back-link">
                <a href="/">
                    <i class="fas fa-arrow-left"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>

    <script>
        // Set selected role
        function setRole(role) {
            document.getElementById('selectedRole').value = role;

            // Update active tab styling
            const tabs = document.querySelectorAll('.role-tab');
            tabs.forEach(tab => {
                if (tab.dataset.role === role) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });

            // Optional: Update form action or placeholder text based on role
            const emailInput = document.querySelector('input[name="email"]');
            if (role === 'admin') {
                emailInput.placeholder = 'admin@fcdynamo.com';
            } else {
                emailInput.placeholder = 'journalist@fcdynamo.com';
            }
        }

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-password i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.classList.remove('fa-eye');
                toggleBtn.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleBtn.classList.remove('fa-eye-slash');
                toggleBtn.classList.add('fa-eye');
            }
        }

        // Auto-fill demo credentials on tab click (for testing)
        function fillDemoCredentials(role) {
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.getElementById('password');

            if (role === 'admin') {
                emailInput.value = 'admin@fcdynamo.com';
                passwordInput.value = 'admin123';
            } else {
                emailInput.value = 'journalist@fcdynamo.com';
                passwordInput.value = 'journal123';
            }
        }

        // Add click handler to demo items
        document.querySelectorAll('.demo-item').forEach((item, index) => {
            item.style.cursor = 'pointer';
            item.addEventListener('click', () => {
                const role = index === 0 ? 'admin' : 'journalist';
                setRole(role);
                fillDemoCredentials(role);
            });
        });
    </script>
</body>

</html>
