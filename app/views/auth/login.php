<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800;900&family=JetBrains+Mono:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/glass.css') ?>">
</head>
<body>
<div class="login-wrap">
    <div class="login-card">
        <span class="print-marks" aria-hidden="true"><i></i><i></i><i></i><i></i></span>

        <div class="brand">
            <span class="brand-mark">B</span>
            <span class="brand-name">Borris Activity</span>
        </div>

        <h1>Admin Login</h1>
        <p class="login-sub">Log in to manage product</p>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="<?= site_url('auth/attempt') ?>" method="post">
            <div class="row">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="admin" placeholder="admin" autocomplete="username" required>
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="admin123" placeholder="••••••••" autocomplete="current-password" required>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Unlock</button>
            </div>
        </form>

        <div class="creds">admin / admin123</div>
    </div>
</div>
</body>
</html>