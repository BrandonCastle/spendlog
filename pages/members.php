<?php
require '../config/db.php';
$result = $conn->query("SELECT * FROM members");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Members - SpendLog</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .member { border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 15px; }
        .member h2 { margin: 0 0 5px 0; }
        .member .student-id { color: #888; font-size: 0.9em; margin-bottom: 8px; }
        .member .role { font-style: italic; margin-bottom: 8px; }
        a { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Team Members</h1>
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="member">
        <h2><?= htmlspecialchars($row['name']) ?></h2>
        <div class="student-id">Student ID: <?= htmlspecialchars($row['student_id']) ?></div>
        <div><?= htmlspecialchars($row['bio']) ?></div>
    </div>
    <?php endwhile; ?>
    <a href="../index.php">← Back</a>
</body>
</html>
