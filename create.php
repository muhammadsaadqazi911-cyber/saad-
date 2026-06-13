<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room_number'];
    $block = $_POST['block'];
    $capacity = $_POST['capacity'];
    $occupied = $_POST['occupied'];
    $monthly_fee = $_POST['monthly_fee'];

    $stmt = $conn->prepare("INSERT INTO rooms (room_number, block, capacity, occupied, monthly_fee) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiid", $room_number, $block, $capacity, $occupied, $monthly_fee);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Room</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; max-width: 400px; border-radius: 8px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 20px; background: #e17055; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <a class="back" href="index.php">&larr; Back to list</a>
    <h1>Add New Room</h1>
    <form method="POST" action="create.php">
        <label>Room Number</label>
        <input type="text" name="room_number" required>

        <label>Block</label>
        <input type="text" name="block" required>

        <label>Capacity</label>
        <input type="number" name="capacity" required>

        <label>Occupied</label>
        <input type="number" name="occupied" required>

        <label>Monthly Fee</label>
        <input type="number" step="0.01" name="monthly_fee" required>

        <button type="submit">Add Room</button>
    </form>
</body>
</html>
