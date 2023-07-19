<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['patient_email'])) {
    // User is already logged in, redirect to the appointment page
    header("Location: patientstatus.php");
    exit();
}

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform your login logic here
    // ...

    // Assuming login is successful and you have retrieved the patient's email
    $patient_email = "example@example.com";

    // Store the patient's email in the session
    $_SESSION['patient_email'] = $patient_email;

    // Redirect to the appointment page
    header("Location: patient.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content here -->
</head>
<body>
    <h1>Login</h1>

    <form method="post" action="">
        <!-- Login form fields -->
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Log in</button>
    </form>
</body>
</html>
