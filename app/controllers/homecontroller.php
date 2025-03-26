<?php
namespace MVC\controllers;
use MVC\core\controller;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\controllers\admincontroller;

class HomeController extends Controller {

    protected $auth;

    public function __construct() {
        Session::Start();  // Start session once
        authcontroller::isloggedin(); // Ensure user is logged in
        $this->auth = new admincontroller(); // Initialize once
    }

    public function index() {
        $data = [
            'title' => 'Home Page',
            'admin' => $this->auth->checkauth(), // Set 'admin' directly
        ];
        
        $this->view('home/index', ['data'=> $data]);
    }
}
