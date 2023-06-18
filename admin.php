<?php
require_once "data.php"; // Include the database connection file

// Function to add a new user
function addUser($email, $password, $role) {
    // Validate input parameters and perform necessary checks

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the query to insert the new user into the appropriate table based on the role
    switch ($role) {
        case "doctor":
            $query = "INSERT INTO doctors (email, password) VALUES (?, ?)";
            break;
        case "nurse":
            $query = "INSERT INTO nurses (email, password) VALUES (?, ?)";
            break;
        // Add more cases for other roles as needed

        default:
            // Handle invalid role
            return false;
    }

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Function to remove a user
function removeUser($email, $role) {
    // Validate input parameters and perform necessary checks

    // Prepare and execute the query to remove the user from the appropriate table based on the role
    switch ($role) {
        case "doctor":
            $query = "DELETE FROM doctors WHERE email = ?";
            break;
        case "nurse":
            $query = "DELETE FROM nurses WHERE email = ?";
            break;
        // Add more cases for other roles as needed

        default:
            // Handle invalid role
            return false;
    }

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Function to update a user's password
function updatePassword($email, $role, $newPassword) {
    // Validate input parameters and perform necessary checks

    // Hash the new password for security
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare and execute the query to update the user's password in the appropriate table based on the role
    switch ($role) {
        case "doctor":
            $query = "UPDATE doctors SET password = ? WHERE email = ?";
            break;
        case "nurse":
            $query = "UPDATE nurses SET password = ? WHERE email = ?";
            break;
        // Add more cases for other roles as needed

        default:
            // Handle invalid role
            return false;
    }

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}


