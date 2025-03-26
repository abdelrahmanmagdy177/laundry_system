<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center">Edit Item</h4>
        </div>
        <div class="card-body">
            <form action="<?= path ?>/items/update/<?= $item['id'] ?>" method="POST">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Item Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($item['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Customer Type:</label>
                    <select name="customer_type" class="form-select" required>
                        <option value="civilian" <?= $item['customer_type'] == "civilian" ? 'selected' : '' ?>>Civilian</option>
                        <option value="military" <?= $item['customer_type'] == "military" ? 'selected' : '' ?>>Military</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Operation Type:</label>
                    <select name="operation_type" class="form-select">
                        <option value="1" <?= $item['operation_type_id'] == 1 ? 'selected' : '' ?>>Washing</option>
                        <option value="2" <?= $item['operation_type_id'] == 2 ? 'selected' : '' ?>>Ironing</option>
                        <option value="3" <?= $item['operation_type_id'] == 3 ? 'selected' : '' ?>>Washing and Ironing</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Price:</label>
                    <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($item['price']) ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= path ?>/items/index" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update Item</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
