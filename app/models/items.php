<?php

namespace MVC\models;

use MVC\core\model;

class items extends model{



    public function getAllItems(){
        $data =  model::db()->run("SELECT * FROM items")->fetchALL(); 
        return $data;
    }

    public function getItemsById($id) {
        $data = model::db()->run("
            SELECT items.id, items.name, prices.customer_type, prices.operation_type_id, prices.price
            FROM items
            INNER JOIN prices ON items.id = prices.item_id
            WHERE items.id = ?", [$id])->fetch();
            return $data;

    }

    public function update_item($id, $name) {
        return model::db()->run(
            "UPDATE items 
            SET name = ?
            WHERE id = ?",
            [$name, $id]
        );
    }
    
    // ✅ تحديث `customer_type`, `operation_type_id`, و `price` في جدول `prices`
    public function update_price($item_id, $customer_type, $operation_type, $price) {
        return model::db()->run(
            "UPDATE prices 
            SET customer_type = ?, operation_type_id = ?, price = ?
            WHERE item_id = ?",
            [$customer_type, $operation_type, $price, $item_id]
        );
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
        
        
        public function itemexist($name, $operation_type_id, $customer_type) {
            $count = model::db()->run(
                "SELECT COUNT(*) FROM prices 
                 INNER JOIN items ON prices.item_id = items.id 
                 WHERE items.name = ? AND prices.operation_type_id = ? AND prices.customer_type = ?",
                [$name, $operation_type_id, $customer_type]
            )->fetchColumn();
        
            return $count > 0; // ✅ إذا كان العنصر موجودًا بالفعل، يرجع `true`
           

        }
        
      
    }

    