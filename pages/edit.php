<?php
require '../config/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount      = $_POST['amount'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $date        = $_POST['date'];
    $stmt = $conn->prepare("UPDATE expenses SET amount=?, description=?, category_id=?, date=? WHERE id=?");
    $stmt->bind_param("dsisi", $amount, $description, $category_id, $date, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: ../index.php');
    exit;
}

$result = $conn->query("SELECT * FROM expenses WHERE id=$id");
$expense = $result->fetch_assoc();
$categories = $conn->query("SELECT * FROM categories");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Expense - SpendLog</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        label { display: block; margin-top: 15px; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 20px; cursor: pointer; }
        a { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Edit Expense</h1>
    <form method="POST" action="edit.php?id=<?= $id ?>">
        <label>Amount (Rp)</label>
        <input type="number" name="amount" value="<?= $expense['amount'] ?>" required>

        <label>Description</label>
        <input type="text" name="description" value="<?= htmlspecialchars($expense['description']) ?>">

        <label>Category</label>
        <select name="category_id">
            <?php while ($row = $categories->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>" <?= $row['id'] == $expense['category_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($row['name']) ?>
            </option>
            <?php endwhile; ?>
        </select>

        <label>Date</label>
        <input type="date" name="date" value="<?= $expense['date'] ?>" required>

        <br><button type="submit">Update</button>
    </form>
    <br><a href="../index.php">← Back</a>
</body>
</html>
