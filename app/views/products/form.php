<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($mode ?? 'create') === 'edit' ? 'Edit Product' : 'Create Product' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800;900&family=JetBrains+Mono:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/glass.css') ?>">
</head>
<body>
<div class="app-shell">
    <nav class="navbar">
        <div class="brand">
            <span class="brand-mark">B</span>
            <span class="brand-name">Borris Activity</span>
        </div>
        <div class="links">
            <a href="<?= site_url('products') ?>">Products</a>
            <a href="<?= site_url('products/create') ?>">Add Product</a>
            <a class="link-danger" href="<?= site_url('auth/logout') ?>">Logout</a>
        </div>
    </nav>

    <section class="form-panel">
        <span class="form-kicker"><?= ($mode ?? 'create') === 'edit' ? 'Edit · Existing Stock' : 'New · Stock Entry' ?></span>
        <h2><?= ($mode ?? 'create') === 'edit' ? 'Edit Product' : 'Add New Product' ?></h2>
        <p class="form-hint">Fields with a black tab are required. Press the orange key to commit.</p>
        <span class="print-marks" aria-hidden="true"><i></i><i></i><i></i><i></i></span>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form data-live-form method="post" action="<?= ($mode ?? 'create') === 'edit' ? site_url('products/update/' . ($product['id'] ?? 0)) : site_url('products/store') ?>">
            <div class="row">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name'] ?? '') ?>" placeholder="e.g. LavaLust Notebook" required>
            </div>
            <div class="row">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Short note about the item…" required><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
            </div>
            <div class="form-row">
                <div class="row">
                    <label for="price">Price (PHP)</label>
                    <input type="number" min="0" step="0.01" id="price" name="price" value="<?= htmlspecialchars((float)($product['price'] ?? 0)) ?>" placeholder="0.00" required>
                </div>
                <div class="row">
                    <label for="quantity">Quantity</label>
                    <input type="number" min="0" id="quantity" name="quantity" value="<?= htmlspecialchars((int)($product['quantity'] ?? 0)) ?>" placeholder="0" required>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn" href="<?= site_url('products') ?>">Cancel</a>
                <button type="submit" class="btn btn-primary"><?= ($mode ?? 'create') === 'edit' ? 'Update Product' : 'Save Product' ?></button>
            </div>
        </form>
    </section>
</div>

<script src="<?= base_url('assets/js/products.js') ?>"></script>
</body>
</html>