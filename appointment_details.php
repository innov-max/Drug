<?php
// Include the data.php file for the database connection
require_once 'data.php';

// Start the session
session_start();

// Check if the patient is logged in
if (!isset($_SESSION['patient_email'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the patient's email from the session
$patient_email = $_SESSION['patient_email'];

// Prepare and execute the SELECT query
$stmt = $conn->prepare("SELECT * FROM appointment WHERE email = ?");
$stmt->bind_param("s", $patient_email);
$stmt->execute();

// Fetch the appointment details
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Display the appointment details
if ($appointment) {
    echo "Appointment Details:<br>";
    echo "Appointment ID: " . $appointment['appointment_id'] . "<br>";
    echo "First Name: " . $appointment['fname'] . "<br>";
    echo "Last Name: " . $appointment['lname'] . "<br>";
    echo "Age: " . $appointment['age'] . "<br>";
    echo "Email: " . $appointment['email'] . "<br>";
    echo "Pre-Existing Conditions: " . $appointment['pre-conditions'] . "<br>";
    echo "Status: " . $appointment['status'] . "<br>";
} else {
    echo "No appointment found for the patient.";
}
?>

