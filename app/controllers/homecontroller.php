<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
class HomeController extends Controller {


    public function __construct() {
        $auth = new authcontroller();
        $auth->isloggedin();
    }


    public function index() {
        
        $data = [
            'title' => 'Home Page',
        ];
        $this->view('home/index', $data);
    }
}
