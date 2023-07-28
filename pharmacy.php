<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="logo6.jpg">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="panel.css">
    <title>MedEase - Doctor</title>
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
            $prescriptions_price = $_POST['pres_price'];

            // Prepare and execute the SQL statement to update the appointment data
            $stmt = $conn->prepare("UPDATE appointment SET pres_price = ?, status = 'Paid' WHERE id = ?");
            $stmt->bind_param("si", $prescriptions_price, $appointmentId);
            $stmt->execute();

            // Close the statement
            $stmt->close();

            echo "<p>Precription price updated successfully.</p>";
        }
        ?>

        <h3>Pharmacist's Panel</h3><br>
        <div class="pharmasist-form">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Pre-Conditions</th>
                    <th>Appointment Date</th>
                    <th>Doctor</th>
                    <th>Prescription</th>
                </tr>
                <?php
                // Retrieve booked appointments from the database
                $query = "SELECT * FROM appointment WHERE status = 'Consulted'";
                $result = $conn->query($query);

                // Display the booked appointments in a table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['age']."</td>";
                    echo "<td>".$row['pre-conditions']."</td>";
                    echo "<td>".$row['appointment_date']."</td>";
                    echo "<td>".$row['doctor']."</td>";
                    echo "<td>".$row['prescriptions']."</td>";
                    echo "<td>".$row['pres_price']."</td>";
                    echo "<td>
                        <form method='post'>
                            <input type='hidden' name='appointment_id' value='".$row['id']."'>
                            <input type='text' name='pres_price' placeholder='Prescription Price' required>
                            <button type='submit' class='normal'>Submit</button>
                        </form>
                        <td>";
                    echo "</tr>";
                }

                // Close the result set
                $result->close();
                ?>
            </table>
        </div>
    </section>


       
</body>
</html>