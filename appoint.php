<?php
// Include the file with database connection details
require_once 'data.php';

// Function to sanitize the input data
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $speciality = $_POST['speciality'];
    $DOA = $_POST['DOA'];
    $symptoms = $_POST['symptoms'];

    // Validate and sanitize the form data
    $fname = sanitizeInput($fname);
    $lname = sanitizeInput($lname);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $department = sanitizeInput($department);
    $speciality = sanitizeInput($speciality);
    $DOA = sanitizeInput($DOA);
    $symptoms = sanitizeInput($symptoms);

    // Check if the form data is valid
    if (empty($fname) || empty($lname) || empty($email) || empty($department) || empty($speciality) || empty($DOA) || empty($symptoms)) {
        die("Please fill in all the required fields.");
    }

    if (!$email) {
        die("Invalid email address.");
    }

    // Insert the appointment details into the database
    $sql = "INSERT INTO appointment (fname, lname, email, department, speciality, DOA, symptoms)
            VALUES ('$fname', '$lname', '$email', '$department', '$speciality', '$DOA', '$symptoms')";

    if ($conn->query($sql) === true) {
        echo "Appointment submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedEase</title>
</head>
<body>
    <div>
        <h1>MedEase</h1>
    </div>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h3>Book an Appointment:</h3>
            <label for="fname">First Name:</label><br>
            <input type="text" name="fname" id="fname" required><br>
            <label for="lname">Last Name:</label><br>
            <input type="text" name="lname" id="lname" required><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required><br>
            <label for="department">Department:</label><br>
            <select name="department" id="department" required>
                <option value="Surgical">Surgical</option>
                <option value="Cardiology">Cardiology</option>
                <?php
                // Retrieve departments from the database
                $deptQuery = "SELECT * FROM department";
                $deptResult = $conn->query($deptQuery);

                // Iterate through departments and create options
                while ($deptRow = $deptResult->fetch_assoc()) {
                    $deptName = $deptRow['name'];
                    echo "<option value='$deptName'>$deptName</option>";
                }
                ?>
            </select><br>
            <label for="speciality">Speciality of Doctor:</label><br>
            <select name="speciality" id="speciality" required>
                <option value="">Select Speciality</option>
            </select><br>
            <label for="DOA">Date of Appointment:</label><br>
            <input type="date" name="DOA" id="DOA" required><br>
            <label for="symptoms">Symptoms Experienced:</label><br>
            <input type="text" name="symptoms" id="symptoms" placeholder="Any symptoms experienced during the time of illness" required><br>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Get the specialities based on the selected department
        function getSpecialities() {
            var department = document.getElementById("department").value;
            var specialitySelect = document.getElementById("speciality");

            // Reset the speciality options
            specialitySelect.innerHTML = "<option value=''>Select Speciality</option>";

            // Make AJAX request to get the specialities
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var specialities = JSON.parse(xhr.responseText);

                        // Populate the speciality options
                        specialities.forEach(function(speciality) {
                            var option = document.createElement("option");
                            option.value = speciality;
                            option.text = speciality;
                            specialitySelect.appendChild(option);
                        });
                    } else {
                        console.log("Error: " + xhr.status);
                    }
                }
            };

            xhr.open("GET", "get_specialities.php?department=" + encodeURIComponent(department), true);
            xhr.send();
        }

        // Attach event listener to the department dropdown
        document.getElementById("department").addEventListener("change", getSpecialities);
    </script>
</body>
</html>
