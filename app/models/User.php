<?php

namespace MVC\models;

use MVC\core\model;

class user extends model{



    public function GetUser($username,$password){
        $data =  model::db()->run("SELECT  username,password FROM users WHERE username = ? AND password = ?",[$username,$password])->fetch(); 
        return $data;
    }
}