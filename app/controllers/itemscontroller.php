<?php

namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\models\items;
class itemscontroller extends controller{

 protected $items;
    public function __construct() {
        // Check if the user is logged in
        // Check if the user is an admin
        Session::Start();
        $data = Session::get('user')['role'];
        if (session::get('user')['role'] !== 1) {
            die('You are not authorized to access this page');
        }
    }

    public function index() {
        // Show the list of items (Only Admin)
        $items = new items();
        $data = $items->Get_All_Items_With_Price();
    $this->view('items/index', ['data' => $data]);

    }

    public function create() {
        // Show the add item form (Only Admin)
        $items = new items();
        $data = $items->getAllItems();
       $this->view('items/create', ['data'=>$data]);
    }


    public function store() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['items'])) {
            $query = new items();
            // خريطة لتحويل النصوص إلى أرقام في قاعدة البيانات
            $operation_type_map = [
                "Washing" => 1,
                "Ironing" => 2,
                "Washing and Ironing" => 3
            ];
            foreach ($_POST['items'] as $item) {
                // ✅ تأمين البيانات
                $name = htmlspecialchars(trim(ucfirst(string: $item['name'])));
                $operation_type_text = htmlspecialchars(trim($item['operation_type']));
                $customer_type = htmlspecialchars(trim($item['customer_type']));
                $price = floatval($item['price']); // تأمين الرقم
                
                // تحويل نوع العملية إلى ID
                $operation_type_id = $operation_type_map[$operation_type_text] ?? null;
                
                if($query->itemexist($item['name'],$operation_type_id,$item['customer_type'])){
                    $_SESSION['error'] = "❌ العنصر موجود بالفعل!";
                    helpers::redirect("items/create");
                    exit();
                }
                if ($operation_type_id !== null) {
                    // 🟢 1️⃣ إدخال العنصر في جدول `items` واسترجاع `id`
                    $item_id = $query->add_items($name);

                    // 🟢 2️⃣ إدخال السعر في جدول `prices` بعد الحصول على `item_id`
                    if ($item_id) {
                        $query->add_price($item_id, $customer_type, $operation_type_id, $price);
                    } else {
                        $_SESSION['error'] = "❌ فشل في إضافة العنصر!";
                        helpers::redirect("items/create");
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "❌ نوع العملية غير صالح!";
                    helpers::redirect("items/create");
                    exit();
                }
            }

            // ✅ تخزين رسالة النجاح في الجلسة
            Session::Set('success','the item has been added successfully')['success'] = "✅ تم إضافة العنصر بنجاح!";
            helpers::redirect("items/create");
            exit();
        } else {
            Session::Set('success','error while adding the product');
            helpers::redirect("items/create");
            exit();
        }
    }



    public function edit($id) {
        // Show the edit item form (Only Admin)
        $this->items = new items();
        $data = $this->items->getItemsById($id);
        $this->view('items/edit', ['item' => $data]);
        
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $customer_type = trim($_POST['customer_type']);
            $operation_type = intval($_POST['operation_type_id']);
            $price = floatval($_POST['price']);
    
            if (empty($name) || empty($customer_type) || empty($operation_type) || empty($price)) {
                $_SESSION['error'] = "All fields are required!";
                helpers::redirect("items/edit/$id");
                exit;
            }
    
            $this->items = new items();
            $query = $this->items;
    
            // ✅ تحديث اسم العنصر في جدول `items`
            $updated_item = $query->update_item($id, $name);
    
            // ✅ تحديث السعر والبيانات الأخرى في جدول `prices`
            if ($updated_item) {
                $updated_price = $query->update_price($id, $customer_type, $operation_type, $price);
                if ($updated_price) {
                    $_SESSION['success'] = "Item updated successfully!";
                    helpers::redirect("items/index");
                    exit;
                }
            }
    
            $_SESSION['error'] = "Failed to update item!";
            helpers::redirect("items/edit/$id");
        }
    }
    

    public function delete($id) {
        // Process deleting an item (Only Admin)
    }
}
?>