<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\controllers\permissioncontroller;


class usercontroller implements permissioncontroller{

   public function checkauth(): bool{
        return Session::get('user')['role'] === 2;
   }
    }

?>