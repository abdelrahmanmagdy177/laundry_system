<?php

namespace MVC\controllers;

use MVC\core\Controller;
use MVC\core\Helpers;
use MVC\core\Session;
use MVC\models\User;

class authcontroller extends Controller {
    private $userModel;

    public function __construct() {
        Session::Start();
        $this->userModel = new User();
    }

    public static function isloggedin() {
        // Start session if not already started
        Session::Start();
    
        // Check if user is already logged in
        if (Session::get('user')) {
            // If user is on the login page, redirect them to another page
            $currentUrl = $_SERVER['REQUEST_URI'];
            if (strpos($currentUrl, 'auth/login') !== false) {
                Helpers::redirect('home/index'); // Redirect logged-in users away from login page
                exit;
            }
        }
    }
    

    public function login() {
        self::isloggedin();
        $this->view('auth/login', []);
    }

    public function postlogin() {
        $username = htmlspecialchars(trim($_POST['username']));
        $password = $_POST['password'];

        $user = $this->userModel->user_auth($username, $password);

        if ($user) {
            Session::set('user', [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role_id']
            ]);
            Helpers::redirect('home/index');
        } else {
            Helpers::redirect('auth/login?error=invalid_credentials');
        }
    }

    public function logout() {
        Session::Stop();
        Helpers::redirect('auth/login');
    }
}