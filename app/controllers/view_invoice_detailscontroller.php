<?php 
namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\Session;
use MVC\models\view_invoices;
use MVC\models\view_invoices_details;
use MVC\models\items;

class view_invoice_detailscontroller extends controller {

    private $invoiceModel;
    private $invoiceItemsModel;
    public function __construct( ){
        Session::Start();
        authcontroller::isloggedin();

    }

    public function render($id) {
        $this->invoiceModel = new view_invoices_details();
        $this->invoiceItemsModel = new items();
        $invoice_id = $id;
        $invoice = $this->invoiceModel->getInvoiceById($invoice_id);
        $invoiceItems = $this->invoiceModel->getInvoiceItems($invoice_id);
        $get_items = $this->invoiceItemsModel->getAllItems();
        $this->view('invoices/view_invoice_details', [
            'invoice' => $invoice,
            'invoiceItems' => $invoiceItems,
            'items'=>$get_items
        ]);
    }
}