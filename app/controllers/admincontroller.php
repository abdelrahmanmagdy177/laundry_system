<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\controllers\permissioncontroller;


class admincontroller implements permissioncontroller{


        public function checkauth(): bool {
            // Check if the session key exists before accessing it
            $user = Session::get('user');
            return isset($user['role']) && $user['role'] === 1;
        }
    }
    
?>