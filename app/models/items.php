<?php

namespace MVC\models;

use MVC\core\model;

class items extends model{



    public function getAllItems(){
        $data =  model::db()->run("SELECT * FROM items")->fetchALL(); 
        return $data;
    }
    public function Get_All_Items_With_Price(){
        $operationTypes = [
            1 => "Washing",
            2 => "Ironing",
            3 => "Washing & Ironing"
        ];
     
            $data  = model::db()->rows("
                SELECT 
                    items.id, 
                    items.name, 
                    prices.customer_type,
                    prices.operation_type_id,
                    prices.price
                FROM items 
                LEFT JOIN prices ON items.id = prices.item_id
            ");
            
            return $data;
        }
        public function add_items($name) {
            try {
                $db = model::db(); 
                $db->run("INSERT INTO items (name) VALUES (?)", [$name]);
        
                $lastId = $db->lastInsertId(); // 🔹 الحصول على آخر ID
                if (!$lastId) {
                    die("❌ lastInsertId() فشل في جلب ID جديد!");
                }
        
                return $lastId; 
            } catch (PDOException $e) {
                die("❌ Error inserting item: " . $e->getMessage()); 
            }
        }
        
        
        
        public function add_price($item_id, $customer_type,$operation_type_id, $price) {
           $data =  model::db()->run("INSERT INTO prices (item_id, customer_type,operation_type_id, price) VALUES (?, ?, ?,?)", [$item_id, $customer_type, $operation_type_id, $price]);
        }
        
        
    }