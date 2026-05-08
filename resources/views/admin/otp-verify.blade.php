<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification - Admin Panel</title>
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
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
        }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        .otp-card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.4);
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            z-index: 1;
        }
        @keyframes fadeInUp { from { opacity:0; transform:translateY(40px); } to { opacity:1; transform:translateY(0); } }

        .otp-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--royal-blue), var(--sky-blue));
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 12px 40px rgba(59,130,246,0.4);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100% { transform:scale(1); } 50% { transform:scale(1.05); } }
        .otp-icon i { font-size: 2.25rem; color: white; }

        .otp-header { text-align: center; margin-bottom: 36px; }
        .otp-header h2 { color: var(--primary-navy); font-weight: 800; font-size: 1.75rem; margin-bottom: 8px; }
        .otp-header p { color: #64748B; font-size: 0.95rem; }

        .otp-inputs { display: flex; gap: 10px; justify-content: center; margin-bottom: 28px; }
        .otp-digit {
            width: 52px; height: 62px;
            border: 2px solid #E2E8F0;
            border-radius: 14px;
            font-size: 1.6rem;
            font-weight: 800;
            text-align: center;
            color: var(--primary-navy);
            background: #F8FAFC;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }
        .otp-digit:focus {
            border-color: var(--royal-blue);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.15);
            background: white;
            outline: none;
        }
        .otp-digit.filled { border-color: var(--royal-blue); background: rgba(59,130,246,0.05); }

        .btn-verify {
            background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
            border: none; color: white;
            font-weight: 700; padding: 16px;
            border-radius: 14px; width: 100%;
            font-size: 1.05rem;
            transition: all 0.3s;
            box-shadow: 0 6px 20px rgba(59,130,246,0.35);
        }
        .btn-verify:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(59,130,246,0.45); }

        .resend-section { text-align: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid #E2E8F0; }
        .resend-btn {
            background: none; border: none;
            color: var(--royal-blue); font-weight: 600;
            cursor: pointer; font-size: 0.9rem;
            transition: color 0.3s;
        }
        .resend-btn:hover { color: var(--primary-blue); text-decoration: underline; }
        .resend-btn:disabled { color: #94A3B8; cursor: not-allowed; text-decoration: none; }

        .alert-box {
            border-radius: 12px; padding: 14px 16px;
            margin-bottom: 20px; font-size: 0.9rem;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-danger-box { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #DC2626; }
        .alert-success-box { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #059669; }

        .timer { font-size: 0.85rem; color: #94A3B8; }
        .timer span { font-weight: 700; color: #DC2626; }

        @media (max-width: 480px) {
            .otp-card { padding: 32px 24px; }
            .otp-digit { width: 44px; height: 54px; font-size: 1.4rem; }
        }
    </style>
</head>
<body>
<div class="otp-card">
    <div class="otp-header">
        <div class="otp-icon"><i class="fas fa-shield-alt"></i></div>
        <h2>OTP Verification</h2>
        <p>Aap ke email pe 6-digit OTP bheja gaya hai.<br>Enter karke admin panel access karein.</p>
    </div>

    @if($errors->any())
    <div class="alert-box alert-danger-box">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    @if(session('resent'))
    <div class="alert-box alert-success-box">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('resent') }}</span>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.otp.verify') }}" id="otpForm">
        @csrf
        <input type="hidden" name="otp" id="otpHidden">

        <div class="otp-inputs">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="0" autocomplete="off">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="1" autocomplete="off">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="2" autocomplete="off">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="3" autocomplete="off">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="4" autocomplete="off">
            <input type="text" class="otp-digit" maxlength="1" inputmode="numeric" data-index="5" autocomplete="off">
        </div>

        <div class="text-center mb-3">
            <span class="timer">OTP valid hai: <span id="countdown">10:00</span></span>
        </div>

        <button type="submit" class="btn-verify" id="verifyBtn">
            <i class="fas fa-check-circle me-2"></i> Verify & Login
        </button>
    </form>

    <div class="resend-section">
        <p style="color:#64748B; font-size:0.88rem; margin-bottom:10px;">OTP nahi aaya?</p>
        <form method="POST" action="{{ route('admin.otp.resend') }}" style="display:inline;">
            @csrf
            <button type="submit" class="resend-btn" id="resendBtn">
                <i class="fas fa-redo me-1"></i> Resend OTP
            </button>
        </form>
        <div style="margin-top:16px; padding-top:16px; border-top:1px solid #E2E8F0;">
            <a href="{{ route('admin.login') }}" style="color:#94A3B8; font-size:0.85rem; text-decoration:none;">
                <i class="fas fa-arrow-left me-1"></i> Wapas Login pe jayein
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const digits = document.querySelectorAll('.otp-digit');
    const hiddenInput = document.getElementById('otpHidden');

    digits.forEach(function(input, idx) {
        input.addEventListener('input', function(e) {
            const val = e.target.value.replace(/\D/g, '');
            e.target.value = val.slice(0, 1);
            if (val && idx < 5) digits[idx + 1].focus();
            updateHidden();
            if (val) e.target.classList.add('filled');
            else e.target.classList.remove('filled');
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && idx > 0) {
                digits[idx - 1].focus();
                digits[idx - 1].value = '';
                digits[idx - 1].classList.remove('filled');
                updateHidden();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            paste.split('').slice(0, 6).forEach(function(ch, i) {
                if (digits[i]) {
                    digits[i].value = ch;
                    digits[i].classList.add('filled');
                }
            });
            if (digits[Math.min(paste.length, 5)]) digits[Math.min(paste.length, 5)].focus();
            updateHidden();
        });
    });

    function updateHidden() {
        hiddenInput.value = Array.from(digits).map(d => d.value).join('');
    }

    digits[0].focus();

    // Countdown timer: 10 minutes
    let seconds = 600;
    const countdownEl = document.getElementById('countdown');
    const timer = setInterval(function() {
        seconds--;
        if (seconds <= 0) {
            clearInterval(timer);
            countdownEl.textContent = '00:00';
            countdownEl.style.color = '#DC2626';
            document.getElementById('verifyBtn').disabled = true;
            document.getElementById('verifyBtn').innerHTML = '<i class="fas fa-times me-2"></i> OTP Expired';
            return;
        }
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        countdownEl.textContent = m + ':' + s;
    }, 1000);

    // Submit on 6 digits
    document.getElementById('otpForm').addEventListener('submit', function() {
        updateHidden();
        document.getElementById('verifyBtn').disabled = true;
        document.getElementById('verifyBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Verifying...';
    });
});
</script>
</body>
</html>
