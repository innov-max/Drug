<?php
// Include the file with database connection details
require_once 'data.php';

// Check if the department parameter is provided
if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Sanitize the department input
    $department = sanitizeInput($department);

    // Prepare and execute a database query to retrieve specialities based on the department
    $stmt = $conn->prepare("SELECT speciality FROM doctors WHERE department = ?");
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $result = $stmt->get_result();

    $specialities = array();

    // Fetch specialities and add them to the array
    while ($row = $result->fetch_assoc()) {
        $specialities[] = $row['speciality'];
    }

    // Return the specialities as JSON response
    echo json_encode($specialities);
}

$conn->close();
?>

