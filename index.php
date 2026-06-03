<?php
require 'config/db.php';

$result = $conn->query("
    SELECT expenses.id, expenses.amount, expenses.description, expenses.date, categories.name AS category
    FROM expenses
    LEFT JOIN categories ON expenses.category_id = categories.id
    ORDER BY expenses.date DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SpendLog</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        h1 { margin-bottom: 5px; }
        nav a { margin-right: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
        .actions a { margin-right: 10px; }
    </style>
</head>
<body>
    <h1>SpendLog</h1>
    <nav>
        <a href="pages/add.php">+ Add Expense</a>
        <a href="pages/summary.php">Summary</a>
<a href="pages/members.php">Members</a>
    </nav>

    <table>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td>NT$<?= number_format($row['amount'], 0) ?></td>
            <td class="actions">
                <a href="pages/edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="pages/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this expense?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
