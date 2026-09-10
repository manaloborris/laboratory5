<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | LavaLust CRUD</title>
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

    <section class="card-list">
        <div class="product-header">
            <div class="header-block">
                <span class="kicker">LavaLust / CRUD</span>
                <div class="title">Product Inventory</div>
                <div class="subtitle">Laboratory 5</div>
            </div>
            <div class="header-tools">
                <span class="count-badge"><?= sprintf('%02d', isset($products) && is_array($products) ? count($products) : 0) ?><small>items</small></span>
                <a class="btn btn-primary" href="<?= site_url('products/create') ?>">+ Add Product</a>
            </div>
            <span class="print-marks" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="flash success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="product-grid">
            <?php if (!empty($products)): ?>
                <?php $i = 0; ?>
                <?php foreach ($products as $product): ?>
                    <?php $i++; ?>
                    <?php $qty = (int)($product['quantity'] ?? 0); ?>
                    <article class="product-card">
                        <div class="card-head">
                            <span class="idx">#<?= sprintf('%02d', $i) ?></span>
                            <span class="sku">SKU-<?= sprintf('%04d', (int)($product['id'] ?? 0)) ?></span>
                            <span class="chip <?= $qty > 0 ? 'chip-ok' : 'chip-bad' ?>"><?= $qty > 0 ? 'In Stock' : 'Out' ?></span>
                        </div>

                        <div class="name"><?= htmlspecialchars($product['product_name'] ?? '') ?></div>
                        <p class="description"><?= htmlspecialchars($product['description'] ?? '') ?></p>

                        <div class="price-tag">
                            <span class="tag-label">Price (PHP)</span>
                            <strong class="tag-value">&#8369;<?= number_format((float)($product['price'] ?? 0), 2) ?></strong>
                            <span class="barcode" aria-hidden="true"><?php
                                $seed = (int)($product['id'] ?? 1);
                                for ($bar = 0; $bar < 15; $bar++) {
                                    echo (($seed * ($bar + 7)) % 5) < 3 ? '<b></b>' : '<b class="gap"></b>';
                                }
                            ?></span>
                        </div>

                        <dl class="specs">
                            <div><dt>Qty on Hand</dt><dd><?= $qty ?></dd></div>
                            <div><dt>Total Value (PHP)</dt><dd>&#8369;<?= number_format((float)($product['price'] ?? 0) * $qty, 2) ?></dd></div>
                        </dl>

                        <div class="product-actions">
                            <a class="btn" href="<?= site_url('products/edit/' . ($product['id'] ?? 0)) ?>">Edit</a>
                            <a class="btn btn-danger" href="<?= site_url('products/delete/' . ($product['id'] ?? 0)) ?>" onclick="return confirm('Delete this product?')">Delete</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <article class="product-card">
                    <div class="card-head">
                        <span class="idx">#</span>
                        <span class="sku">Product</span>
                        <span class="chip chip-bad">Empty</span>
                    </div>
                    <div class="name">No Products Found</div>
                    <p class="description">The shelf is empty. Add product na.</p>
                    <div class="product-actions">
                        <a class="btn btn-primary" href="<?= site_url('products/create') ?>">+ Add Product</a>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </section>
</div>

<script src="<?= base_url('assets/js/products.js') ?>"></script>
</body>
</html>