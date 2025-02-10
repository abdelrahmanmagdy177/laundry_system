<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الفاتورة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function enableEdit() {
            document.getElementById("edit-form").style.display = "block";
            document.getElementById("view-mode").style.display = "none";
        }
    </script>
</head>

<body class="bg-light">

<div class="container my-4">
    <h2 class="text-center">📝 تفاصيل الفاتورة</h2>
    <!-- وضع العرض -->
    <div id="view-mode" class="card p-3">
        <p><strong>رقم الفاتورة:</strong> <?= isset($invoice['id']) ? $invoice['id'] : 'N/A'; ?></p>
        <p><strong>اسم العميل:</strong> <?= isset($invoice['customer_name']) ? $invoice['customer_name'] : 'غير متوفر'; ?></p>
        <p><strong>رقم الجناح:</strong> <?= isset($invoice['room_number']) ? $invoice['room_number'] : 'غير متوفر'; ?></p>
        <p><strong>السعر الإجمالي:</strong> <?= isset($invoice['total_price']) ? $invoice['total_price'] . ' جنيه' : 'غير متوفر'; ?></p>

        <h4>البنود</h4>
        <ul>
            <?php if (!empty($invoiceItems)): ?>
                <?php foreach ($invoiceItems as $item): ?>
                    <li><?= $item['item_name']; ?> - نوع العملية: <?= $item['service_type']; ?> - الكمية: <?= $item['quantity']; ?> - السعر: <?= $item['price']; ?> جنيه</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>لا توجد بنود في هذه الفاتورة</li>
            <?php endif; ?>
        </ul>

        <button class="btn btn-warning" onclick="enableEdit()">✏️ تعديل</button>
        <a href="generate_pdf.php?id=<?= $invoice['id']; ?>" class="btn btn-success">📄 تحميل PDF</a>
        <a href="index.php" class="btn btn-secondary">⬅️ رجوع</a>
    </div>

    <!-- وضع التعديل -->
    <form action="<?= path ?>edit/update_invoice/<?= $invoice['id']?>" method="POST" id="edit-form" class="card p-3" style="display: none;">
        <input type="hidden" name="invoice_id" value="<?= $invoice['id']; ?>">

        <div class="mb-3">
            <label class="form-label">اسم العميل</label>
            <input type="text" name="customer_name" class="form-control" value="<?= $invoice['customer_name']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">نوع العميل</label>
            <input type="text" name="customer_type" class="form-control" value="<?= $invoice['customer_type']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رقم الجناح</label>
            <input type="text" name="room_number" class="form-control" value="<?= $invoice['room_number']; ?>" required>
        </div>

        <h4>تعديل البنود</h4>
        <div id="items-container">
            <?php foreach ($invoiceItems as $item): ?>
                <div class="row mb-2">
                    <input type="hidden" name="items[<?= isset($item['id']) ? $item['id'] : 'new'; ?>][id]" value="<?= isset($item['id']) ? $item['id'] : ''; ?>">
                    <div class="col-md-3">
                        <select name="items[<?= $item['id']; ?>][name]" class="form-control">
                            <?php foreach($items as $item_name): ?>
                                <option value="<?= $item_name['name']; ?>" <?= ($item['item_name'] == $item_name['name']) ? 'selected' : ''; ?>>
                                    <?= $item_name['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="items[<?= $item['id']; ?>][service_type]" class="form-control">
                            <option value="Washing" <?= ($item['service_type'] == 'Washing') ? 'selected' : ''; ?>>غسيل</option>
                            <option value="Ironing" <?= ($item['service_type'] == 'Ironing') ? 'selected' : ''; ?>>كي</option>
                            <option value="Washing and Ironing" <?= ($item['service_type'] == 'Washing and Ironing') ? 'selected' : ''; ?>>غسيل وكي</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="items[<?= $item['id']; ?>][quantity]" class="form-control" value="<?= $item['quantity']; ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <p><strong>الإجمالي:</strong> <span id="total-price"> <?= isset($invoice['total_price']) ? $invoice['total_price'] . ' جنيه' : 'غير متوفر'; ?></span></p>

        <button type="submit" class="btn btn-primary">💾 حفظ التعديلات</button>
    </form>
</div>

</body>
</html>
