<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    
    <div class="title">
        <h1>MEDEASE</h1>
    </div>

    <div class="login-box">
        <h2>Sign Up</h2>
        <?php
        include("data.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $pnumber = filter_input(INPUT_POST, "pnumber", FILTER_SANITIZE_NUMBER_INT);
            $password = filter_input(INPUT_POST, "password");
            

            if (empty($fname) || empty($lname) || empty($email) || empty($pnumber) || empty($password)) {
                echo "Please fill in all the fields";
            } else {
                // Prepare and execute the SQL query
                $stmt = $conn->prepare("INSERT INTO patients (fname, lname, email, pnumber, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $fname, $lname, $email, $pnumber, $password);

                if ($stmt->execute()) {
                    echo "Registration successful";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }

            mysqli_close($conn);
        }
        ?>
        
        <form action="" method="post">
            <div class="user-box">
                <input type="text" name="fname" required>
                <label>First name:</label>
            </div>
            <div class="user-box">
                <input type="text" name="lname" required>
                <label>Last Name:</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email:</label>
            </div>
            <div class="user-box">
                <input type="tel" name="pnumber" required>
                <label>Phone Number:</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password:</label>
            </div>
            <input type="submit" name="submit" value="Sign up" class="sign-up-btn">

        </form>
    </div>
    

<script>
	
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>


