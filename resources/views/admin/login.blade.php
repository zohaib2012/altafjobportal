<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - National EduPortal Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary-navy: #0F172A; 
            --primary-blue: #1E40AF; 
            --royal-blue: #3B82F6; 
            --sky-blue: #0EA5E9; 
            --green: #10B981;
            --amber: #FCD34D;
            --orange-gold: #F59E0B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, var(--primary-navy) 0%, #1E3A8A 50%, var(--primary-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            z-index: 1;
        }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        
        .login-header { text-align: center; margin-bottom: 36px; }
        .login-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 12px 40px rgba(59,130,246,0.4);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        .login-icon i { font-size: 2.25rem; color: white; }
        .login-header h2 { color: var(--primary-navy); font-weight: 800; font-size: 1.875rem; margin-bottom: 8px; letter-spacing: -0.5px; }
        .login-header p { color: #64748B; font-size: 1rem; font-weight: 500; }
        
        .form-group { margin-bottom: 24px; }
        .form-group label { font-weight: 600; color: var(--primary-navy); margin-bottom: 10px; display: block; font-size: 0.9rem; }
        .form-control {
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            padding: 16px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #F8FAFC;
        }
        .form-control:focus { border-color: var(--royal-blue); box-shadow: 0 0 0 4px rgba(59,130,246,0.15); background: white; }
        
        .btn-login {
            background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
            border: none;
            color: white;
            font-weight: 700;
            padding: 18px;
            border-radius: 14px;
            width: 100%;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
            letter-spacing: 0.3px;
        }
        .btn-login:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(59,130,246,0.45); }
        .btn-login.disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
        
        .back-link { text-align: center; margin-top: 28px; padding-top: 24px; border-top: 1px solid #E2E8F0; }
        .back-link a { color: #64748B; text-decoration: none; font-weight: 600; transition: all 0.3s; }
        .back-link a:hover { color: var(--royal-blue); }
        
        .logo-row { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 28px; }
        .logo-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(59,130,246,0.3);
        }
        .logo-icon i { color: white; font-size: 1.25rem; }
        
        .error-box {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            display: none;
            animation: shake 0.5s ease;
        }
        .error-box.show { display: flex; align-items: center; gap: 12px; }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
        .error-box i { color: #DC2626; font-size: 1.1rem; }
        .error-box span { color: #DC2626; font-size: 0.9rem; font-weight: 500; }
        
        .input-group { position: relative; }
        .input-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 1rem;
            transition: color 0.3s;
        }
        .input-group .form-control {
            padding-left: 48px;
        }
        .input-group:focus-within i {
            color: var(--royal-blue);
        }

        @media (max-width: 480px) {
            .login-card { padding: 32px 24px; }
            .login-icon { width: 64px; height: 64px; }
            .login-icon i { font-size: 1.75rem; }
            .login-header h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="logo-row">
                <div class="logo-icon" style="background:none;box-shadow:none;padding:0;overflow:hidden;">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width:48px;height:48px;object-fit:contain;" onerror="this.style.display='none';this.insertAdjacentHTML('afterend','<i class=\'fas fa-graduation-cap\' style=\'color:white;font-size:1.25rem;\'></i>')">
                </div>
            </div>
            <h2>Admin Panel</h2>
            <p>National EduPortal Hub</p>
        </div>

        <div class="error-box" id="errorBox">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMsg"></span>
        </div>

        <form id="loginForm">
            @csrf
            <input type="hidden" name="_token" id="csrfToken" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-login" id="submitBtn">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
        
        <div class="back-link">
            <a href="/"><i class="fas fa-arrow-left me-2"></i> Back to Home</a>
        </div>
    </div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const email    = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const token    = document.getElementById('csrfToken').value;
        const btn      = document.getElementById('submitBtn');
        const errorBox = document.getElementById('errorBox');
        const errorMsg = document.getElementById('errorMsg');

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Logging in...';
        errorBox.classList.remove('show');

        try {
            const response = await fetch('/admin/login', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: 'email=' + encodeURIComponent(email) +
                      '&password=' + encodeURIComponent(password) +
                      '&_token=' + encodeURIComponent(token)
            });

            const data = await response.json();

            if (data.success && data.redirect) {
                btn.innerHTML = '<i class="fas fa-check me-2"></i> OTP Bheja Ja Raha Hai...';
                window.location.href = data.redirect;
            } else {
                errorMsg.innerHTML = data.message || 'Invalid email or password.';
                errorBox.classList.add('show');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i> Login';
            }
        } catch (error) {
            errorMsg.textContent = 'An error occurred. Please try again.';
            errorBox.classList.add('show');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i> Login';
        }
    });
    </script>
</body>
</html>