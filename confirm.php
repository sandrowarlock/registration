<?php

session_start();
require('connection.php');
include 'chromePhp.php';
?>

<html>
	<head><title>Registration</title></head>
	<body>

	<?php

		if(empty($_GET['email']) OR empty($_GET['key'])) {
			echo "Something went wrong. Please check if you pasted the link into your browser correctly.";
		}
		else {
			$email = $_GET['email'];
			$key = $_GET['key'];

			$check_query = "SELECT * FROM users WHERE email = '$email' AND email_key = '$key' AND email_confirm = 0 LIMIT 1";
			$key_check = $conn->query($check_query);
			$row_count = $key_check->num_rows;

			if ($row_count == 1) {
				$confirm_query_1 = "UPDATE users SET email_confirm = 1, email_key = 0 WHERE email = '$email' AND email_key = '$key' LIMIT 1";
				$conn->query($confirm_query_1);
				$conn->close();
				echo "Thank you for confirming your email! <a href='login.php'>Go to login page</a>";
			}
			else {
				echo "This email is already confirmed. <a href='login.php'>Go to login page</a>";
			}
		}

	?>
	</body>
</html>