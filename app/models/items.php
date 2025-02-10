<?php

namespace MVC\models;

use MVC\core\model;

class items extends model{



    public function getAllItems(){
        $data =  model::db()->run("SELECT * FROM items")->fetchALL(); 
        return $data;
    }
}