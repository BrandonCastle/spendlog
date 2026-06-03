<?php
require '../config/db.php';

$result = $conn->query("
    SELECT categories.name, COUNT(expenses.id) AS total_entries, SUM(expenses.amount) AS total_amount
    FROM categories
    LEFT JOIN expenses ON categories.id = expenses.category_id
    GROUP BY categories.id, categories.name
    ORDER BY total_amount DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Summary - SpendLog</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
        .total { font-weight: bold; border-top: 2px solid #333; }
    </style>
</head>
<body>
    <h1>Summary</h1>
    <table>
        <tr>
            <th>Category</th>
            <th>Entries</th>
            <th>Total</th>
        </tr>
        <?php
        $grand_total = 0;
        while ($row = $result->fetch_assoc()):
            $grand_total += $row['total_amount'];
        ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['total_entries'] ?></td>
            <td>NT$<?= number_format($row['total_amount'], 0) ?></td>
        </tr>
        <?php endwhile; ?>
        <tr class="total">
            <td>Total</td>
            <td></td>
            <td>NT$<?= number_format($grand_total, 0) ?></td>
        </tr>
    </table>
    <br><a href="../index.php">← Back</a>
</body>
</html>
