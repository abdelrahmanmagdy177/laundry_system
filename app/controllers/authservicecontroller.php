<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\core\model;
use MVC\models\User;

// Move interface outside the class
interface AuthServiceInterface {
    public function validateCredentials(string $username, string $password): bool;
    public function createUserSession(array $userData): void;
    public function validateRegistration(string $username, string $email): bool;
}

class authservicecontroller extends Controller {
    public model $user;
    private $authService;

    public function __construct(AuthServiceInterface $authService = null) {
        $this->user = new User();
        $this->authService = $authService;
    }

    public function login() { 
        $this->view('auth/login', []);
    }

    public function postLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
            try {
                if ($this->authService) {
                    if ($this->authService->validateCredentials($username, $password)) {
                        $userData = $this->user->GetUser($username, $password);
                        $this->authService->createUserSession(userData: $userData);
                        helpers::redirect(path . 'home/index');
                    } else {
                        throw new \Exception('Invalid credentials');
                    }
                } else {
                    // Fallback to original login logic
                    $data = $this->user->GetUser($username, $password);
                    if ($data) {
                        Session::set('user', $data);
                        helpers::redirect(path . 'home/index');
                    } else {
                        throw new \Exception('Invalid username or password');
                    }
                }
            } catch (\Exception $e) {
                $this->view('auth/login', ['error' => $e->getMessage()]);
            }
        }
    }

    public function logout() {
        Session::Stop();
        helpers::redirect(path . 'auth/login');
    }
    
    public function register() {
        $this->view('auth/register', []);
    }

    public function postRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if ($this->user->checkUserExists($username, $email)) {
                echo 'User already exists';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->user->createUser($username, $hashedPassword, $email);
                helpers::redirect(path . 'auth/login');
            }
        }
    }
}