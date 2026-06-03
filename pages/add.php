<?php
require '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount      = $_POST['amount'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $date        = $_POST['date'];
    $stmt = $conn->prepare("INSERT INTO expenses (amount, description, category_id, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("dsis", $amount, $description, $category_id, $date);
    $stmt->execute();
    $stmt->close();
    header('Location: ../index.php');
    exit;
}
$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Expense - SpendLog</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        label { display: block; margin-top: 15px; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 20px; cursor: pointer; }
        a { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Add Expense</h1>
    <form method="POST" action="add.php">
        <label>Amount (NT$)</label>
        <input type="number" name="amount" required>
        <label>Description</label>
        <input type="text" name="description">
        <label>Category</label>
        <select name="category_id">
            <?php while ($row = $categories->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>
        <label>Date</label>
        <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
        <br><button type="submit">Save</button>
    </form>
    <br><a href="../index.php">← Back</a>
</body>
</html>
