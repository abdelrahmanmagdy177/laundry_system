<?php
namespace MVC\models;

use MVC\core\model;
use Exception;

class edit_invoice extends model {

    public function updateInvoice($invoice_id, $customer_name, $room_number, $customer_type, $items, $user_id) {
        $operationTypes = [
            "Washing" => 1,
            "Ironing" => 2,
            "Washing and Ironing" => 3
        ];
        
        $total_invoice_price = 0;
        $validatedItems = [];

        // ✅ تحقق من جميع العناصر أولًا
        foreach ($items as $item) {
            $operationTypeId = (int) ($operationTypes[$item['service_type']] ?? null);
            $itemName = trim($item['name']);

            $itemData = model::db()->run(
                "SELECT i.id, p.price 
                 FROM items i
                 INNER JOIN prices p ON i.id = p.item_id
                 WHERE i.name = ? AND p.operation_type_id = ? AND p.customer_type = ?",
                [$item['name'], $operationTypeId, $customer_type]
            )->fetch();

            if (!$itemData) {
                throw new Exception("❌ خطأ: البند '{$itemName}' غير موجود لنوع العملية '{$item['service_type']}' ونوع العميل '{$customer_type}'!");
            }

            $item['id'] = $itemData['id'];
            $item['price'] = $itemData['price'];
            $item['total_price'] = $item['quantity'] * $itemData['price'];
            $total_invoice_price += $item['total_price'];

            $validatedItems[] = $item;
        }

        // ✅ تحديث بيانات الفاتورة
        model::db()->run(
            "UPDATE invoices 
             SET customer_name = ?, room_number = ?, customer_type = ?, total_price = ?, is_modified = 1, updated_by = ? 
             WHERE id = ?",
            [$customer_name, $room_number, $customer_type, $total_invoice_price, $user_id, $invoice_id]
        );

        // ✅ تحديث عناصر الفاتورة
        foreach ($validatedItems as $item) {
            model::db()->run(
                "UPDATE invoice_items 
                 SET quantity = ?, service_type = ?, price = ?, total_price = ? 
                 WHERE invoice_id = ? AND item_id = ?",
                [$item['quantity'], $item['service_type'], $item['price'], $item['total_price'], $invoice_id, $item['id']]
            );
        }

        return "✅ الفاتورة تم تحديثها بنجاح!";
    }
}
