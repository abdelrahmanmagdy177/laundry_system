<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="<?= path; ?>back/css/create_item.css">
</head>
<body>
    <?php

    if (isset($_SESSION['success'])) {
        echo "<p style='color: green; font-weight: bold;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']); // مسح الرسالة بعد عرضها
    }
    
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red; font-weight: bold;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // مسح الرسالة بعد عرضها
    }
    
    ?>
    <form action="store" method="POST">
        <h3>Create Item</h3>
        <h3>Items</h3>
        <table id="itemsTable">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Operation Type</th>
                    <th>Customer Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="items">
                <tr>
                    <td>
                        <select name="items[0][name]" required>
                        <?php foreach ($data as $item): ?>
                            <option value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="items[0][operation_type]" required>
                            <option value="Washing">Washing</option>
                            <option value="Ironing">Ironing</option>
                            <option value="Washing and Ironing">Washing and Ironing</option>
                        </select>
                    </td>
                    <td>
                        <select name="items[0][customer_type]" required>
                            <option value="civilian">Civilian</option>
                            <option value="military">Military</option>
                        </select>
                    </td>
                    <td> 
                        <input type="number" name="items[0][price]" required>  
                    </td>
                    <td>
                        <button type="button" class="remove-item-btn" onclick="removeItem(this)">Remove</button>
                        <button type="button" class="add-item-btn" onclick="addItem()">Add Item</button>
                        <button type="submit" name="btn">Create</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <script>
        let itemIndex = 1;
        const availableItems = <?= json_encode($data) ?>; // تحويل بيانات PHP إلى JSON

        function addItem() {
            const table = document.getElementById('items');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="items[${itemIndex}][name]" required>
                        ${availableItems.map(item => `<option value="${item.name}">${item.name}</option>`).join('')}
                    </select>
                </td>
                <td>
                    <select name="items[${itemIndex}][operation_type]" required>
                        <option value="Washing">Washing</option>
                        <option value="Ironing">Ironing</option>
                        <option value="Washing and Ironing">Washing and Ironing</option>
                    </select>
                </td>
                <td>
                    <select name="items[${itemIndex}][customer_type]" required>
                        <option value="civilian">Civilian</option>
                        <option value="military">Military</option>
                    </select>
                </td>
                <td> 
                    <input type="number" name="items[${itemIndex}][price]" required>  
                </td>
                <td><button type="button" class="remove-item-btn" onclick="removeItem(this)">Remove</button></td>
            `;
            table.appendChild(row);
            itemIndex++;
        }

        function removeItem(button) {
            button.closest("tr").remove();
        }
    </script>
</body>
</html>
