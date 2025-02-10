<?php 
namespace MVC\controllers;

use MVC\core\controller;
use MVC\core\Session;
use MVC\models\view_invoices;

class View_invoicecontroller extends controller {
private $invoiceModel;
    public function __construct( ){
        Session::Start();
        authcontroller::isloggedin();

    }

    public function render() {
        $this->invoiceModel = new view_invoices();
        $civilianInvoices = $this->invoiceModel->getInvoicesByType('civilian');
        $militaryInvoices = $this->invoiceModel->getInvoicesByType('military');
        $todayInvoices = $this->invoiceModel->getTodayInvoices();

        $this->view('invoices/view_invoices', [
            'civilianInvoices' => $civilianInvoices,
            'militaryInvoices' => $militaryInvoices,
            'todayInvoices' => $todayInvoices
        ]);
    }
    
}
?>
