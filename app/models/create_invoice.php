<?php

namespace MVC\models;

use MVC\core\model;

class create_invoice extends model {
    
    public function createInvoice($user_id, $customer_name, $room_number, $customer_type, $items) {
        // إنشاء الرقم التسلسلي بناءً على نوع العميل
        $serial_number = $this->generateSerialNumber($customer_type);
        // إدخال بيانات الفاتورة
        $insertInvoice = model::db()->run(
            "INSERT INTO invoices (user_id, customer_name, room_number, customer_type, serial_number, total_price) 
             VALUES (?, ?, ?, ?, ?, ?)",
            [$user_id, $customer_name, $room_number, $customer_type, $serial_number, 0]
        );

        // التأكد من أن الفاتورة تم إنشاؤها
        if (!$insertInvoice) {
            die("Error: Failed to create invoice.");
        }

        // ✅ 1. Try getting last inserted ID using PDO
        $invoice_id = model::db()->lastInsertId();

        // ✅ 2. Fallback: Get the latest inserted invoice ID for the user
        if (!$invoice_id) {
            $checkInvoice = model::db()->run(
                "SELECT id FROM invoices WHERE user_id = ? ORDER BY id DESC LIMIT 1",
                [$user_id]
            )->fetch();
            $invoice_id = $checkInvoice['id'] ?? null;
        }

        // ✅ 3. Fallback: Use MySQL's LAST_INSERT_ID() function
        if (!$invoice_id) {
            $invoice_id = model::db()->run("SELECT LAST_INSERT_ID()")->fetchColumn();
        }

        // If no ID was retrieved, stop execution
        if (!$invoice_id) {
            die("Error: Failed to get invoice ID.");
        }

        $total_invoice_price = 0;
        $operationTypes = [
            "Washing" => 1,
            "Ironing" => 2,
            "Washing and Ironing" => 3
        ];
        
        // إدخال العناصر المرتبطة بالفاتورة
        foreach ($items as $item) {
            $operationTypeId = (int) ($operationTypes[$item['operation_type']] ?? null);
            $itemName = trim($item['name']);
                        
            $itemData = model::db()->run(
                "SELECT i.id, p.price 
                 FROM items i
                 INNER JOIN prices p ON i.id = p.item_id
                 WHERE i.name = ? AND p.operation_type_id = ? AND p.customer_type = ?",
                [$item['name'], $operationTypeId, $customer_type]
            )->fetch();
            
            if (!$itemData) {
                die("Error: Item '{$itemName}' with operation type '{$item['operation_type']}' and customer type '{$customer_type}' not found.");
            }
            

            $item_id = $itemData['id'];
            $price = $itemData['price'];
            $total_price = $item['quantity'] * $price;
            $total_invoice_price += $total_price;
            $op_type = $item['operation_type'];

            // إدراج المنتج في الفاتورة
            $insertItem = model::db()->run(
                "INSERT INTO invoice_items (invoice_id, item_id, quantity, service_type, price, total_price) 
                 VALUES (?, ?, ?, ?, ?, ?)", // Now 6 placeholders ✅
                [$invoice_id, $item_id, $item['quantity'], $op_type, $price, $total_price]
            );
            

            if (!$insertItem) {
                // حذف الفاتورة والعناصر إذا حدث خطأ
                model::db()->run("DELETE FROM invoices WHERE id = ?", [$invoice_id]);
                model::db()->run("DELETE FROM invoice_items WHERE invoice_id = ?", [$invoice_id]);
                die("Error: Failed to insert item '{$item['name']}'. Invoice deleted.");
            }
        }

        // تحديث إجمالي الفاتورة
        $updateInvoice = model::db()->run(
            "UPDATE invoices SET total_price = ? WHERE id = ?",
            [$total_invoice_price, $invoice_id]
        );

        if (!$updateInvoice) {
            // حذف الفاتورة والعناصر إذا فشل التحديث
            model::db()->run("DELETE FROM invoices WHERE id = ?", [$invoice_id]);
            model::db()->run("DELETE FROM invoice_items WHERE invoice_id = ?", [$invoice_id]);
            die("Error: Failed to update invoice total price. Invoice deleted.");
        }

        return $invoice_id;
    }

    private function generateSerialNumber($customer_type) {
        $last_serial = model::db()->run(
            "SELECT serial_number FROM invoices WHERE customer_type = ? ORDER BY id DESC LIMIT 1",
            [$customer_type]
        )->fetch();

        if ($last_serial && isset($last_serial['serial_number'])) {
            preg_match('/\d+/', $last_serial['serial_number'], $matches);
            $last_number = isset($matches[0]) ? (int) $matches[0] : 0;
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        $prefix = ($customer_type === 'military') ? 'MIL-' : 'CIV-';

        return $prefix . str_pad($new_number, 6, '0', STR_PAD_LEFT);
    }
}
