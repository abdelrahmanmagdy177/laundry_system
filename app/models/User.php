<?php

namespace MVC\models;

use MVC\core\model;

class user extends model{



    public function user_auth($username,$password){
        $data =  model::db()->run("SELECT * FROM users WHERE username = ? AND password = ?",[$username,$password])->fetch(); 
        return $data;
    }
}