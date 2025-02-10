<?php namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\models\create_invoice;
use MVC\models\edit_invoice;
use MVC\models\items;
use MVC\models\invoice;
use Exception;

class editcontroller extends controller{

    private $edit_invoice_model;

    public function __construct(){
        Session::Start();
        authcontroller::isloggedin();
    }
    public function update_invoice(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $invo_id = $_POST['invoice_id'];
                $cust_name = $_POST['customer_name'];
                $room_number = $_POST['room_number'];
                $items = $_POST['items'];
                $cust_type = $_POST['customer_type'];
                $user_id = Session::get('user')['id'];                
                $edit_invoice_model = new edit_invoice();
                $result = $edit_invoice_model->updateInvoice($invo_id, $cust_name, $room_number, $cust_type, $items,$user_id);
                
                echo json_encode([
                    "status" => "success",
                    "message" => 'تم تحديث الفاتورة بنجاح'
                ],JSON_UNESCAPED_UNICODE);
            }catch (\Exception $e) { 
                echo json_encode([
                    "status" => "error",
                    "message" => "⚠️ حدث خطأ أثناء تحديث الفاتورة. يرجى التأكد من صحة البيانات."
                ], JSON_UNESCAPED_UNICODE);
            }
            
            }
        }
    }
    
