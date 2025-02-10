<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
class permissioncontroller extends Controller {


    public function __construct() {
        Session::Start();
        if(Session::get('user')['role'] != 1){
            Helpers::redirect('home/index');
        }
    
    }
}