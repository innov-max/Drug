<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve the logged-in user's ID and role from the session
$id = $_SESSION['id'];
$role = $_SESSION['role'];

// Display a personalized welcome message based on the user's role
$welcomeMessage = "";
if ($role === "doctor") {
    $welcomeMessage = "Welcome, Doctor $id!";
} elseif ($role === "nurse") {
    $welcomeMessage = "Welcome, Nurse $id!";
} else {
    $welcomeMessage = "Welcome, User $id!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docify - Home</title>
</head>
<body>
    <h1>Docify</h1>
    <h2><?php echo $welcomeMessage; ?></h2>
    <p>This is the homepage for <?php echo $role; ?> <?php echo $id; ?>.</p>
    <p>Customize this page with your content.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
