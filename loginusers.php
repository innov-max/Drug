<?php
require_once "data.php"; // Include the database connection file

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM doctors WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}


if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM managers WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM nurses WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM pharmacists WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM receptionists WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM patients WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
    
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: medease.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    
        mysqli_stmt_close($stmt);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedEase</title>
    <link rel="stylesheet" href="login2.css">
</head>
<body>
    <h1 name="title">MedEase</h1>
    <div class="login-box">
        <form method="POST" action="">
            <div class="head">
                <h1>Login</h1>
            </div>
            <div class="user-box">
                <label for="email">Email:</label><br>
                <input type="email" name="email" required><br>
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