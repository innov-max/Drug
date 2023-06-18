<?php
// Include the database connection file
require_once "data.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $username = $_POST["username"];

    // Prepare and execute the query to remove a user
    $query = "DELETE FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) === 1) {
        echo "User removed successfully.";
    } else {
        echo "Failed to remove user.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove User</title>
</head>
<body>
    <h1>Remove User</h1>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br><br>
        <input type="submit" value="Remove User">
    </form>
</body>
</html>
