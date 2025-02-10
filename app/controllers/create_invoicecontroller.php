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
    public function create(){
      
            $customer_name = $_POST['customer_name'];
            $room_number = $_POST['room_number'];
            $customer_type = $_POST['customer_type'];
            $items = $_POST['items'];
            $user_id = Session::get('user')['id'];
            $invoice_id = $this->invoiceModel->createInvoice($user_id, $customer_name, $room_number, $customer_type, $items);
        
    }

 
}
?>