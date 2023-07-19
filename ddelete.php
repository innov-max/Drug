<?php
require_once "data.php"; // Include the database connection file

// Check if the form is submitted
if (isset($_POST['delete'])) {
    // Retrieve the form data
    $doctor_id = $_POST['id'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];

    // Prepare the SQL statement to delete the doctor
    $sql = "DELETE FROM doctors WHERE ";

    // Build the WHERE clause based on the provided fields
    if (!empty($doctor_id)) {
        $sql .= "id = $doctor_id";
    } elseif (!empty($first_name) && !empty($last_name)) {
        $sql .= "first_name = '$first_name' AND last_name = '$last_name'";
    } else {
        echo "Please provide either the doctor's ID or both the first and last name.";
        exit;
    }

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Doctor deleted successfully.";
    } else {
        echo "Error deleting doctor: " . $conn->error;
    }
}
?>
