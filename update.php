<?php
include 'db.php';

// Start output buffering
ob_start();

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Redirect after successful update
        header("Location: index.php");
        exit; // Always use exit after header to stop further execution
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
