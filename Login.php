
<?php
require_once "data.php"; // Include the database connection file

// Function to redirect the user to another page
function redirect($page) {
    header("Location: $page");
    exit();
}

// Start the session
session_start();

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $id = $_POST['Id'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        // Prepare and execute the query for doctors
        $query = "SELECT * FROM doctors WHERE id = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "is", $id, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Store the user's ID and role in session variables
            $_SESSION['id'] = $id;
            $_SESSION['role'] = "doctor";

            redirect("about.html"); // Redirect to the desired page
        } else {
            // Check for nurses
            $query = "SELECT * FROM nurses WHERE id = ? AND password = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "is", $id, $password);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                // Store the user's ID and role in session variables
                $_SESSION['id'] = $id;
                $_SESSION['role'] = "nurse";

                redirect("about.html"); // Redirect to the desired page
            } else {
                echo "Invalid ID or password";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docify</title>
    <link rel="stylesheet" href="login2.css">
</head>
<body>
    <h1 name="title">Docify</h1>
    <div class="login-box">
        <form method="POST" action="">
            <div class="head">
                <h1>Login</h1>
            </div>
            <div class="user-box">
                <label for="User_Id">User Id</label><br>
                <input type="number" name="Id" required><br>
            </div>
            <div class="user-box">
                <label for="password">Password:</label><br>
                <input type="password" name="password"><br>
            </div>
            <center>
            <input type="submit" name="submit" value="LogIn" class="log-in-btn">
            </center>
        </form>
    </div>
</body>
</html>
