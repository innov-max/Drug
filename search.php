<?php
require_once "data.php"; // Include the database connection file

// Search Doctor
if (isset($_POST['search'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to search for a doctor by ID
    $stmt = $conn->prepare("SELECT * FROM doctors WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>MedEase</title>
</head>
<body>
    <h1>MedEase Administrator</h1>

    <h2>Search Doctor:</h2>
    <div>
        <form action="" method="POST">
            <label for="id">ID</label><br>
            <input type="number" name="id" id="id"><br>
            <label for="fname">First Name:</label><br>
            <input type="text" name="fname" id="fname" value="<?php echo isset($doctor) ? $doctor['fname'] : ''; ?>"><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" name="lname" id="lname" value="<?php echo isset($doctor) ? $doctor['lname'] : ''; ?>"><br>
            <label for="DOE">Date of Employment:</label><br>
            <input type="date" name="DOE" id="DOE" value="<?php echo isset($doctor) ? $doctor['DOE'] : ''; ?>"><br>
            <label for="department">Department:</label><br>
            <input type="text" name="department" id="department" value="<?php echo isset($doctor) ? $doctor['department'] : ''; ?>"><br>
            <label for="speciality">Speciality:</label><br>
            <input type="text" name="speciality" id="speciality" value="<?php echo isset($doctor) ? $doctor['speciality'] : ''; ?>"><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" value="<?php echo isset($doctor) ? $doctor['email'] : ''; ?>"><br>
            <label for="pnumber">Phone Number:</label><br>
            <input type="number" name="pnumber" id="pnumber" value="<?php echo isset($doctor) ? $doctor['pnumber'] : ''; ?>"><br>
            <br>
            <input type="submit" name="search" value="Search Doctor">
        </form>
    </div>

</body>
</html>
