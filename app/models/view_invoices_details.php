<?php
namespace MVC\models;

use MVC\core\model;

class view_invoices_details extends model {
public function getInvoiceItems($invoice_id) {
    return model::db()->run(
        "SELECT ii.id, ii.quantity, ii.price, ii.total_price, ii.service_type,
                i.name as item_name
         FROM invoice_items ii
         INNER JOIN items i ON ii.item_id = i.id
         WHERE ii.invoice_id = ?",
        [$invoice_id]
    )->fetchAll();
}
public function getInvoiceById($invoice_id) {
    return model::db()->run(
        "SELECT * FROM invoices WHERE id = ?",
        [$invoice_id]
    )->fetch();
}
// ✅ دالة موحدة لجلب الفاتورة مع التفاصيل
public function getInvoiceDetails($invoice_id) {
    $invoice = $this->getInvoiceById($invoice_id);

    if (!$invoice) {
        return null; // الفاتورة غير موجودة
    }

    // جلب العناصر المرتبطة بالفاتورة
    $invoice['items'] = $this->getInvoiceItems($invoice_id);

    return $invoice;
}
}
?>