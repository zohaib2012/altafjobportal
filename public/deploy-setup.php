<?php
// ============================================================
// SAFE DEPLOYMENT SCRIPT — National EduPortal Hub
// Sirf ek baar chalao, phir automatically delete ho jaye gi
// ============================================================

// Security: secret key required
$secret = $_GET['key'] ?? '';
if ($secret !== 'NEPH-DEPLOY-2026') {
    http_response_code(403);
    die('<h2 style="color:red;font-family:sans-serif">403 — Secret key required. Add ?key=NEPH-DEPLOY-2026 to URL</h2>');
}

define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$output = '';
$errors = [];

// ── 1. Migration ──────────────────────────────────────────
try {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $migOut = \Illuminate\Support\Facades\Artisan::output();
    $output .= '<p style="color:green">✅ Migration complete:<br><pre>' . htmlspecialchars($migOut) . '</pre></p>';
} catch (Exception $e) {
    $errors[] = 'Migration: ' . $e->getMessage();
}

// ── 2. Admin Email Update ─────────────────────────────────
try {
    $admin = \App\Models\User::where('role', 'admin')->first();
    if ($admin) {
        $oldEmail = $admin->email;
        $admin->email = 'altafhussainbirhmani376@gmail.com';
        $admin->save();
        $output .= '<p style="color:green">✅ Admin email updated: <b>' . $oldEmail . '</b> → <b>' . $admin->email . '</b></p>';
    } else {
        $output .= '<p style="color:orange">⚠️ Admin user not found — email not updated.</p>';
    }
} catch (Exception $e) {
    $errors[] = 'Admin email: ' . $e->getMessage();
}

// ── 3. Cache Clear ────────────────────────────────────────
try {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    $output .= '<p style="color:green">✅ All caches cleared.</p>';
} catch (Exception $e) {
    $errors[] = 'Cache clear: ' . $e->getMessage();
}

// ── 4. DB Verify (count check — no deletion) ──────────────
try {
    $tables = ['users','positions','applications','challans','documents'];
    $counts = '';
    foreach ($tables as $t) {
        $c = \Illuminate\Support\Facades\DB::table($t)->count();
        $counts .= "<b>$t</b>: $c rows &nbsp;|&nbsp; ";
    }
    $output .= '<p style="color:green">✅ Data safe — Record counts: ' . $counts . '</p>';
} catch (Exception $e) {
    $errors[] = 'DB check: ' . $e->getMessage();
}

// ── 5. Self Delete ────────────────────────────────────────
$selfDeleted = false;
try {
    unlink(__FILE__);
    $selfDeleted = true;
} catch (Exception $e) {
    // ignore
}

// ── Output ────────────────────────────────────────────────
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Deployment Setup</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 20px; }
        h2 { color: #1E40AF; }
        pre { background: #f1f5f9; padding: 10px; border-radius: 8px; font-size: 0.85rem; }
        .error { color: red; background: #fef2f2; border: 1px solid #fca5a5; padding: 10px; border-radius: 8px; margin: 8px 0; }
        .success-box { background: #f0fdf4; border: 2px solid #86efac; border-radius: 12px; padding: 20px; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>National EduPortal Hub — Deployment Setup</h2>
    <p><b>Date:</b> <?= date('Y-m-d H:i:s') ?></p>
    <hr>

    <?= $output ?>

    <?php if (!empty($errors)): ?>
        <h3 style="color:red">Errors:</h3>
        <?php foreach ($errors as $err): ?>
            <div class="error">❌ <?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="success-box">
        <?php if ($selfDeleted): ?>
            <p>🗑️ <b>Script automatically delete ho gaya — secure!</b></p>
        <?php else: ?>
            <p style="color:orange">⚠️ Script manually delete karo: <code>public/deploy-setup.php</code></p>
        <?php endif; ?>
        <p><a href="/admin/login">→ Admin Login pe jao</a></p>
    </div>
</body>
</html>
