<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Product extends Controller
{
    private $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->call->helper('url');
        $this->call->database();
        $this->call->library('session');
        $this->productModel = $this->call->model('ProductModel');
    }

    public function index()
    {
        $this->ensure_logged_in();
        $products = $this->productModel->all();
        $this->call->view('products/index', compact('products'));
    }

    public function create()
    {
        $this->ensure_logged_in();
        $this->call->view('products/form', ['product' => [], 'mode' => 'create']);
    }

    public function store()
    {
        $this->ensure_logged_in();

        $payload = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float)($_POST['price'] ?? 0),
            'quantity' => (int)($_POST['quantity'] ?? 0),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($payload['product_name'] === '' || $payload['description'] === '') {
            $_SESSION['error'] = 'Please complete the product name and description.';
            redirect('products/create');
        }

        $this->productModel->insert($payload);
        $_SESSION['success'] = 'Product created successfully.';
        redirect('products');
    }

    public function edit($id)
    {
        $this->ensure_logged_in();
        $product = $this->productModel->find($id);
        if (!$product) {
            $_SESSION['error'] = 'Product not found.';
            redirect('products');
        }

        $this->call->view('products/form', ['product' => $product, 'mode' => 'edit']);
    }

    public function update($id)
    {
        $this->ensure_logged_in();
        $product = $this->productModel->find($id);
        if (!$product) {
            $_SESSION['error'] = 'Product not found.';
            redirect('products');
        }

        $payload = [
            'product_name' => trim($_POST['product_name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'price' => (float)($_POST['price'] ?? 0),
            'quantity' => (int)($_POST['quantity'] ?? 0)
        ];

        if ($payload['product_name'] === '' || $payload['description'] === '') {
            $_SESSION['error'] = 'Please complete the product name and description.';
            redirect('products/edit/' . $id);
        }

        $this->productModel->update($id, $payload);
        $_SESSION['success'] = 'Product updated successfully.';
        redirect('products');
    }

    public function delete($id)
    {
        $this->ensure_logged_in();
        $product = $this->productModel->find($id);
        if ($product) {
            $this->productModel->delete($id);
            $_SESSION['success'] = 'Product deleted successfully.';
        } else {
            $_SESSION['error'] = 'Product not found.';
        }

        redirect('products');
    }

    private function ensure_logged_in()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            redirect('login');
        }
    }
}
