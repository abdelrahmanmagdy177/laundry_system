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

    public static function  isloggedin() {
        // Check if the user is already on the login page
        $currentUrl = $_SERVER['REQUEST_URI'];
        if (strpos($currentUrl, 'auth/login') !== false) {
            return; // Do not redirect if already on the login page
        }

        // Redirect if the user is not logged in
        if (!Session::get('user')) {
            Helpers::redirect('auth/login');
        }
    }

    public function login() {
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