<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "medease";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        echo "Could not connect!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM receptionists WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: about.html");
            exit();
        } else {
            echo "Invalid email or password";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>
