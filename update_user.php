<?php
// Include the database connection file
require_once "data.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $email = $_POST["email"];

    // Prepare and execute the query to update a user's email
    $query = "UPDATE users SET email = ? WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $username);
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) === 1) {
        echo "User updated successfully.";
    } else {
        echo "Failed to update user.";
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
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label for="email">New Email:</label><br>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Update User">
    </form>
</body>
</html>
