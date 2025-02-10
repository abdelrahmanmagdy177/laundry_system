<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الفواتير</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-box {
            max-height: 400px; 
            overflow-y: auto;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2px;
        }
        .btn-sm {
            font-size: 0.8rem;
            padding: 2px 6px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container my-4">
        <h2 class="text-center mb-4">📋 إدارة الفواتير</h2>

        <div class="row g-3">
            <!-- فواتير المدنيين -->
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white text-center">👤 فواتير المدنيين</div>
                    <div class="card-body invoice-box">
                        <ul class="list-group">
                            <?php foreach ($civilianInvoices as $invoice): ?>
                                <li class="list-group-item">
                                    <span>
                                        <strong>🔹 <?= $invoice['serial_number']; ?></strong> - 
                                        <?= $invoice['customer_name']; ?> | 
                                        جناح: <?= $invoice['room_number']; ?> | 
                                        السعر: <?= $invoice['total_price']; ?> جنيه | 
                                        <small class="text-muted"><?= $invoice['created_at']; ?></small>
                                    </span>
                                    <a href="<?= path ?>view_invoice_details/render/<?= $invoice['id']; ?>" class="btn btn-sm btn-outline-primary">📄 عرض</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- فواتير العسكريين -->
            <div class="col-md-4">
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white text-center">🎖️ فواتير العسكريين</div>
                    <div class="card-body invoice-box">
                        <ul class="list-group">
                            <?php foreach ($militaryInvoices as $invoice): ?>
                                <li class="list-group-item">
                                    <span>
                                        <strong>🔹 <?= $invoice['serial_number']; ?></strong> - 
                                        <?= $invoice['customer_name']; ?> | 
                                        جناح: <?= $invoice['room_number']; ?> | 
                                        السعر: <?= $invoice['total_price']; ?> جنيه | 
                                        <small class="text-muted"><?= $invoice['created_at']; ?></small>
                                    </span>
                                    <a href="<?= path ?>/view_invoice_details/render/<?= $invoice['id']; ?>" class="btn btn-sm btn-outline-primary">📄 عرض</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- فواتير اليوم -->
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-header bg-success text-white text-center">📅 فواتير اليوم</div>
                    <div class="card-body invoice-box">
                        <ul class="list-group">
                            <?php foreach ($todayInvoices as $invoice): ?>
                                <li class="list-group-item">
                                    <span>
                                        <strong>🔹 <?= $invoice['serial_number']; ?></strong> - 
                                        <?= $invoice['customer_name']; ?> | 
                                        جناح: <?= $invoice['room_number']; ?> | 
                                        السعر: <?= $invoice['total_price']; ?> جنيه | 
                                        <small class="text-muted"><?= $invoice['created_at']; ?></small>
                                    </span>
                                    <a href="<?php path ?>/view_invoice_details/render/<?= $invoice['id']; ?>" class="btn btn-sm btn-outline-primary">📄 عرض</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
