<?php
require_once "data.php";

// Add Pharmacists
if (isset($_POST['add'])) {
    // Retrieve the form data
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $date_of_employment = $_POST['DOE'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];

    // Perform validation on the data
    $errors = array();

    // Validate first name and last name (not empty and alphanumeric)
    if (empty($first_name) || empty($last_name)) {
        $errors[] = "First name and last name are required.";
    } elseif (!ctype_alnum($first_name) || !ctype_alnum($last_name)) {
        $errors[] = "First name and last name should be alphanumeric.";
    }

    // Validate email (not empty and a valid email format)
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate phone number (not empty and numeric)
    if (empty($pnumber) || !is_numeric($pnumber)) {
        $errors[] = "Phone number is required and should be numeric.";
    }

    // If there are no validation errors, proceed with inserting the pharmacist into the database
    if (empty($errors)) {
        // Prepare and execute the SQL statement to insert the pharmacist into the 'pharmacist's' table
        $sql = "INSERT INTO pharmacists (fname, lname, DOE, department, email, pnumber, password)
                VALUES ('$first_name', '$last_name', '$date_of_employment', '$department', '$email', '$pnumber', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Pharmacist added successfully.";
        } else {
            echo "Error adding Pharmacist: " . $conn->error;
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}




// Edit Pharmacist Information.
if (isset($_POST['edit'])) {
    // Retrieve the form data
    $pharmacist_id = $_POST['id'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to update the pharmacist's information
    $sql = "UPDATE pharmacists SET ";

    // Build the update query based on the provided fields
    if (!empty($first_name)) {
        $sql .= "fname = '$first_name', ";
    }
    if (!empty($last_name)) {
        $sql .= "lname = '$last_name', ";
    }
    if (!empty($department)) {
        $sql .= "department = '$department', ";
    }
    if (!empty($email)) {
        $sql .= "email = '$email', ";
    }
    if (!empty($pnumber)) {
        $sql .= "pnumber = '$pnumber', ";
    }
    if (!empty($password)) {
        $sql .= "password = '$password', ";
    }

    // Remove the trailing comma and space from the SQL statement
    $sql = rtrim($sql, ', ');

    // Add the WHERE clause to specify the pharmacist to update
    $sql .= " WHERE id = $pharmacist_id";

    if ($conn->query($sql) === TRUE) {
        echo "Pharmacist information updated successfully.";
    } else {
        echo "Error updating Pharmacist information: " . $conn->error;
    }
}

// Delete Pharmacist.
if (isset($_POST['delete'])) {
    // Retrieve the form data
    $pharmacist_id = $_POST['id'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];

    // Prepare the SQL statement to delete the Pharmacist
    $sql = "DELETE FROM pharmacists WHERE ";

    // Build the WHERE clause based on the provided fields
    if (!empty($pharmacist_id)) {
        $sql .= "id = $pharmacist_id";
    } elseif (!empty($first_name) && !empty($last_name)) {
        $sql .= "fname = '$first_name' AND lname = '$last_name'";
    } else {
        echo "Please provide either the Pharmacist's ID or both the first and last name.";
        exit;
    }

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Update the remaining records' IDs
        $update_query = "UPDATE pharmacists SET id = id - 1 WHERE id > $pharmacist_id";
        if ($conn->query($update_query) === TRUE) {
            echo "Pharmacist deleted successfully and IDs renumbered.";
        } else {
            echo "Error updating IDs: " . $conn->error;
        }
    } else {
        echo "Error deleting Pharmacist: " . $conn->error;
    }
}

//search a Pharmacist.
if (isset($_POST['search'])) {
    $id = $_POST['id'];

    // Prepare the SQL statement to search for a Pharmacist by ID
    $stmt = $conn->prepare("SELECT * FROM pharmacists WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $pharmacist = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedEase</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>MedEase Administrator</h1>

    <div class="container">
        <div class="form-section">
            <h2>Add Pharmacist:</h2>
            <form action="" method="POST">
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>    
                <label for="DOE">Date:</label><br>
                <input type="date" name="DOE" id="DOE" required><br>
                <label for="department">Department:</label><br>
                <input type="text" name="department" id="department" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" required><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required><br>
                <br>
                <input type="submit" name="add" value="Add Pharmacist">
            </form>
        </div>

        <div class="form-section">
            <h2>Edit Pharmacist:</h2>
            <form action="" method="POST">
                <label for="id">Pharmacist ID:</label><br>
                <input type="text" name="id" id="id" required><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>
                <label for="department">Department:</label><br>
                <input type="text" name="department" id="department" ><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" ><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" ><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" ><br>
                <br>
                <input type="submit" name="edit" value="Edit Pharmacist">
            </form>
        </div>

        <div class="form-section">
            <h2>Delete Pharmacist:</h2>
            <form action="" method="POST">
                <label for="id">Pharmacist ID:</label><br>
                <input type="text" name="id" id="id" required><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" required><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" required><br>
                <br>
                <input type="submit" name="delete" value="Delete Pharmacist">
            </form>
        </div>
        
        <div class="form-section">
            <h2>Search Pharmacist:</h2>
            <form action="" method="POST">
                <label for="id">ID</label><br>
                <input type="number" name="id" id="id"><br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" value="<?php echo isset($pharmacist) ? $pharmacist['fname'] : ''; ?>"><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" value="<?php echo isset($pharmacist) ? $pharmacist['lname'] : ''; ?>"><br>
                <label for="DOE">Date of Employment:</label><br>
                <input type="date" name="DOE" id="DOE" value="<?php echo isset($pharmacist) ? $pharmacist['DOE'] : ''; ?>"><br>
                <label for="department">Department:</label><br>
                <input type="text" name="department" id="department" value="<?php echo isset($pharmacist) ? $pharmacist['department'] : ''; ?>"><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="<?php echo isset($pharmacist) ? $pharmacist['email'] : ''; ?>"><br>
                <label for="pnumber">Phone Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" value="<?php echo isset($pharmacist) ? $pharmacist['pnumber'] : ''; ?>"><br>
                <br>
                <input type="submit" name="search" value="Search Pharmacist">
            </form>
        </div>
    </div>
</body>
</html>