<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
.wrapper { max-width: 520px; margin: 40px auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
.header { background: linear-gradient(135deg, #0F172A 0%, #1E40AF 100%); padding: 32px; text-align: center; }
.header h2 { color: #fff; margin: 0; font-size: 22px; }
.header p { color: rgba(255,255,255,0.75); margin: 6px 0 0; font-size: 14px; }
.body { padding: 36px 40px; }
.body p { color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 16px; }
.otp-box { background: #EFF6FF; border: 2px solid #BFDBFE; border-radius: 12px; padding: 24px; text-align: center; margin: 24px 0; }
.otp-code { font-size: 42px; font-weight: 800; letter-spacing: 12px; color: #1E40AF; font-family: 'Courier New', monospace; }
.otp-note { font-size: 13px; color: #6B7280; margin: 8px 0 0; }
.warning { background: #FEF3C7; border: 1px solid #FCD34D; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #92400E; }
.footer { background: #F9FAFB; padding: 20px 40px; text-align: center; font-size: 12px; color: #9CA3AF; border-top: 1px solid #E5E7EB; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h2>Admin Login Verification</h2>
        <p>National EduPortal Hub</p>
    </div>
    <div class="body">
        <p>Assalam-o-Alaikum,</p>
        <p>Admin panel login ka request aaya hai. Neeche diya gaya <strong>One-Time Password (OTP)</strong> use karein:</p>
        <div class="otp-box">
            <div class="otp-code">{{ $otp }}</div>
            <div class="otp-note">Yeh OTP <strong>10 minutes</strong> ke liye valid hai</div>
        </div>
        <div class="warning">
            <strong>Security Notice:</strong> Agar aap ne login nahi kiya toh yeh email ignore karein aur apna password immediately change karein.
        </div>
        <p style="margin-top:20px; font-size:13px; color:#6B7280;">Yeh OTP sirf aap ke liye hai. Kisi se share na karein.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} National EduPortal Hub. All rights reserved.
    </div>
</div>
</body>
</html>
