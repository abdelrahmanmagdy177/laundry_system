<?php namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\helpers;
use MVC\core\Session;
use MVC\controllers\authcontroller;
use MVC\models\create_invoice;
use MVC\models\items;
use MVC\models\invoice;

class create_invoicecontroller extends Controller {

    private $itemsModel;
    private $items;
    private $invoiceModel;

    public function __construct(){
        Session::Start();
        // Initialize the items model
        $this->itemsModel = new items();
        authcontroller::isloggedin();
        
        // Capture the items data
        $this->items = $this->itemsModel->getAllItems();
        $this->invoiceModel = new create_invoice();
    }

    public function render() {
        // Pass the items data to the view
        $this->view('invoices/create_invoice', ['data' => $this->items]);
    }
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ✅ التحقق من وجود البيانات وتطهيرها
            $customer_name  = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_STRING);
            $room_number    = filter_input(INPUT_POST, 'room_number', FILTER_SANITIZE_NUMBER_INT);
            $customer_type  = filter_input(INPUT_POST, 'customer_type', FILTER_SANITIZE_STRING);
            $items          = $_POST['items'] ?? [];
            $user_id        = Session::get('user')['id'] ?? null;
    
            // ✅ التأكد من أن جميع الحقول المطلوبة غير فارغة
            if (!$user_id || !$customer_name || !$room_number || !$customer_type || empty($items)) {
                die("Error: Missing required fields.");
            }
    
            // ✅ التحقق من نوع العميل (يفضل جعلها قائمة ثابتة)
            $valid_customer_types = ['military', 'civilian'];
            if (!in_array($customer_type, $valid_customer_types)) {
                die("Error: Invalid customer type.");
            }
    
            // ✅ التحقق من أن العناصر المدخلة مصفوفة وليست بيانات خاطئة
            if (!is_array($items) || count($items) === 0) {
                die("Error: Invalid items data.");
            }
    
            // ✅ تنظيف بيانات العناصر قبل تمريرها للدالة
            $sanitized_items = [];
            foreach ($items as $item) {
                if (!isset($item['name'], $item['quantity'], $item['operation_type'])) {
                    die("Error: Invalid item structure.");
                }
    
                $item_name = filter_var($item['name'], FILTER_SANITIZE_STRING);
                $quantity = filter_var($item['quantity'], FILTER_VALIDATE_INT);
                $operation_type = filter_var($item['operation_type'], FILTER_SANITIZE_STRING);
    
                if (!$item_name || !$quantity || !$operation_type) {
                    die("Error: Invalid item data.");
                }
    
                $sanitized_items[] = [
                    'name' => $item_name,
                    'quantity' => $quantity,
                    'operation_type' => $operation_type
                ];
            }
    
            // ✅ تمرير البيانات إلى دالة إنشاء الفاتورة
            $invoice_id = $this->invoiceModel->createInvoice($user_id, $customer_name, $room_number, $customer_type, $sanitized_items);
    
            if (!$invoice_id) {
                die("Error: Failed to create invoice.");
            }
    
            // ✅ نجاح العملية
            echo "Invoice created successfully with ID: " . $invoice_id;
        } else {
            die("Error: Invalid request method.");
        }
    }
    
 
}
?>