<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="<?= path; ?>back/css/create_invoice.css">
</head>
<body>
    <form action="/create_invoice/create" method="POST">
        <h3>Invoice Details</h3>
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        
        <label for="room_number">Room Number:</label>
        <input type="number" id="room_number" name="room_number" required>

        <label for="customer_type">Customer Type:</label>
        <select id="customer_type" name="customer_type" required>
            <option value="civilian">Civilian</option>
            <option value="military">Military</option>
        </select>

        <h3>Items</h3>
        <table id="itemsTable">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Operation Type</th>
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
                    <td><input type="number" name="items[0][quantity]" min="1" required></td>
                    <td>
                        <select name="items[0][operation_type]" required>
                            <option value="Washing">Washing</option>
                            <option value="Ironing">Ironing</option>
                            <option value="Washing and Ironing">Washing and Ironing</option>
                        </select>
                    </td>
                    <td><button type="button" class="remove-item-btn" onclick="removeItem(this)">Remove</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="add-item-btn" onclick="addItem()">Add Item</button>
        <br>
        <button type="submit" name="btn">Create Invoice</button>
    </form>

    <script>
        let itemIndex = 1;
        const availableItems = <?= json_encode($data) ?>; // Store PHP items in JavaScript

        function addItem() {
            const table = document.getElementById('items');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="items[${itemIndex}][name]" required>
                        ${availableItems.map(item => `<option value="${item.name}">${item.name}</option>`).join('')}
                    </select>
                </td>
                <td><input type="number" name="items[${itemIndex}][quantity]" min="1" required></td>
                <td>
                    <select name="items[${itemIndex}][operation_type]" required>
                        <option value="Washing">Washing</option>
                        <option value="Ironing">Ironing</option>
                        <option value="Washing and Ironing">Washing and Ironing</option>
                    </select>
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
