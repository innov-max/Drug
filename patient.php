<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="panel.css">
    <title>MedEase - Patient</title>
</head>
<body>
    <section id="header">
        <a href="#"><img src="logo7.jpg" class="logo" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="about.html">About</a></li>
                <a href="#" id="close"><i class="fa fa-times" aria-hidden="true"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="form">
        <?php
        // Include the data.php file for the database connection
        require_once 'data.php';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $conditions = $_POST['conditions'];

            // Prepare and execute the SQL statement to insert the appointment data
            $stmt = $conn->prepare("INSERT INTO appointment (fname, lname, age, email,`preconditions`, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
            $stmt->bind_param("ssiss", $fname, $lname, $age, $email, $conditions);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Appointment booked successfully.</p>";
        }
        ?>

        <h3>Book Appointment</h3><br>
        <div class="patient-form">
            <form method="post">
                <label>Patient First Name</label><br>
                <input type="text" name="fname" required><br>
                <label>Patient Last Name</label><br>
                <input type="text" name="lname" required><br>
                <label>Patient Age</label><br>
                <input type="number" name="age" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <label>Any Pre-Existing Conditions</label><br>
                <input type="text" name="conditions" required><br>
                <button type="submit" class="normal">Submit</button><br><br>
            </form>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img src="logo2.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>489 Kitusuri Road, Street 77, Nairobi</p>
            <p><strong>Phone: </strong> +254 797 093 831 /(020) 01 1436 1483</p>
            <p><strong>Hours: </strong> 24/7, Including Holidays</p>
            <a href="index.html">Home</a>
            <a href="index.html">Services</a>
            <a href="index.html">About</a>
            <div class="follow">
                <h4>Follow us:</h4>
                <div class="icon">
                    <a href="https://twitter.com/home" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://web.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
