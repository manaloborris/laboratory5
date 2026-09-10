<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->helper('url');
        $this->call->library('session');
    }

    public function login()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            redirect('products');
        }

        $this->call->view('auth/login');
    }

    public function attempt()
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = 'admin';
            $_SESSION['success'] = 'Welcome back, admin.';
            redirect('products');
        }

        $_SESSION['error'] = 'Invalid credentials.';
        redirect('login');
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        redirect('login');
    }
}
