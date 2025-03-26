<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
interface permissioncontroller  {


    public function checkauth(): bool;
    
    }
