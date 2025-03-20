<!DOCTYPE html>
<html lang="en">
   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
        .table-container {
            max-height: 500px; /* تحديد ارتفاع الجدول */
            overflow-y: auto;  /* تمرير عمودي */
            overflow-x: auto;  /* تمرير أفقي */
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            padding: 10px;
        }
        .table thead {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }
        .action-buttons a {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Items List</h2>
    <div class="table-container">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>customer_type</th>
                    <th>Type</th>
                    <th>price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['customer_type']) ?></td>
                            <td><?= htmlspecialchars($item['operation_type_id']) ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td class="action-buttons">
                                <a href="/items/edit/<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/items/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-3">
        <a href="/items/create" class="btn btn-success">Add New Item</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
