CREATE DATABASE IF NOT EXISTS lab5_products;
USE lab5_products;

DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    quantity INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (product_name, description, price, quantity, created_at) VALUES
('LavaLust Notebook', 'A minimal notebook for tracking app ideas.', 250.00, 12, '2026-09-09 08:00:00'),
('Glass UI Pack', 'A premium glassmorphism interface asset set.', 190.50, 30, '2026-09-09 08:10:00'),
('Aiven Starter Kit', 'Starter kit for cloud-ready MySQL workflows.', 320.75, 8, '2026-09-09 08:20:00');
