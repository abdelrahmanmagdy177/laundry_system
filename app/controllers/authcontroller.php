<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;

class authcontroller extends Controller {


    public function __construct() {
    
    }


    public function isloggedin() {
        if(Session::get('user')){
            helpers::redirect('home/index');
        }
        helpers::redirect('account/login');
    }
}
