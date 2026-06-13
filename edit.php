<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room_number'];
    $block = $_POST['block'];
    $capacity = $_POST['capacity'];
    $occupied = $_POST['occupied'];
    $monthly_fee = $_POST['monthly_fee'];

    $stmt = $conn->prepare("UPDATE rooms SET room_number = ?, block = ?, capacity = ?, occupied = ?, monthly_fee = ? WHERE id = ?");
    $stmt->bind_param("ssiidi", $room_number, $block, $capacity, $occupied, $monthly_fee, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit();
}

// Fetch existing room data
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Room not found.";
    exit();
}

$room = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Room</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; max-width: 400px; border-radius: 8px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 20px; background: #2196F3; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .back { display: inline-block; margin-bottom: 15px; text-decoration: none; color: #333; }
    </style>
</head>
<body>
    <a class="back" href="index.php">&larr; Back to list</a>
    <h1>Edit Room</h1>
    <form method="POST" action="edit.php?id=<?php echo $room['id']; ?>">
        <label>Room Number</label>
        <input type="text" name="room_number" value="<?php echo htmlspecialchars($room['room_number']); ?>" required>

        <label>Block</label>
        <input type="text" name="block" value="<?php echo htmlspecialchars($room['block']); ?>" required>

        <label>Capacity</label>
        <input type="number" name="capacity" value="<?php echo $room['capacity']; ?>" required>

        <label>Occupied</label>
        <input type="number" name="occupied" value="<?php echo $room['occupied']; ?>" required>

        <label>Monthly Fee</label>
        <input type="number" step="0.01" name="monthly_fee" value="<?php echo $room['monthly_fee']; ?>" required>

        <button type="submit">Update Room</button>
    </form>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>
