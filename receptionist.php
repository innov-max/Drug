<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="panel.css">
    <title>MedEase - Receptionist</title>
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
            $appointmentId = $_POST['appointment_id'];
            $appointmentDate = $_POST['appointment_date'];
            $doctor = $_POST['doctor'];

            // Prepare and execute the SQL statement to update the appointment data
            $stmt = $conn->prepare("UPDATE appointment SET appointment_date = ?, doctor = ?, status = 'Booked' WHERE id = ?");
            $stmt->bind_param("ssi", $appointmentDate, $doctor, $appointmentId);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Appointment updated successfully.</p>";
        }
        ?>

        <h3>Receptionist Panel</h3><br>
        <div class="receptionist-form">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Pre-Conditions</th>
                    <th>Appointment Date</th>
                    <th>Action</th>
                </tr>
                <?php
                // Retrieve pending appointments from the database
                $query = "SELECT * FROM appointment WHERE status = 'Pending'";
                $result = $conn->query($query);

                // Display the pending appointments in a table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['age']."</td>";
                    echo "<td>".$row['pre-conditions']."</td>";
                    echo "<td>".$row['appointment_date']."</td>";
                    echo "<td>".$row['doctor']."</td>";
                    echo "<td><form method='post'>
                            <input type='hidden' name='appointment_id' value='".$row['id']."'>
                            <input type='datetime-local' name='appointment_date' required>
                            <input type='text' name='doctor' placeholder='Assign doctor' required>
                            <button type='submit' class='normal'>Book</button>
                        </form></td>";
                    echo "</tr>";
                }

                // Close the result set
                $result->close();
                ?>
            </table>
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
