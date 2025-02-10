<?php

namespace MVC\models;

use MVC\core\model;

class view_invoices extends model {

    // ✅ جلب جميع الفواتير
    public function getInvoices() {
        return model::db()->run("SELECT * FROM invoices")->fetchAll();
    }

    // ✅ جلب الفواتير حسب النوع (مدني - عسكري)
    public function getInvoicesByType($type) {
        return $this->db()->run(
            "SELECT id, customer_name, room_number, serial_number, total_price, created_at 
             FROM invoices 
             WHERE customer_type = ? 
             ORDER BY created_at DESC",
            [$type]
        )->fetchAll();
    }

    // ✅ جلب فواتير اليوم فقط
    public function getTodayInvoices() {
        return $this->db()->run(
            "SELECT id, customer_name, room_number,serial_number, total_price, created_at 
             FROM invoices 
             WHERE DATE(created_at) = CURDATE() 
             ORDER BY created_at DESC"
        )->fetchAll();
    }

    // ✅ جلب بيانات الفاتورة الأساسية
  

    // ✅ جلب جميع العناصر المرتبطة بالفاتورة
    
}
?>
