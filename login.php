<?php 
    include ('connection.php'); // Database connection file
	//include ('navbar.php');
	
	
	// Start session to store login details
	session_start();

	// Initialize error variable
	$error = '';

	// Check if the form is submitted
	if (isset($_POST['submit'])) {
		// Get username and password from the form
		$username = mysqli_real_escape_string($conn, $_POST['name']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		// Check if both fields are filled
		if (empty($username) || empty($password)) {
			$error = "Both fields are required.";
		} else {
			// Query to check if username and password match the database
			$query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password' LIMIT 1";
			$result = mysqli_query($conn, $query);

			// If a match is found
			if (mysqli_num_rows($result) == 1) {
				// Fetch the user details
   				 $user = mysqli_fetch_assoc($result);

				// Store username in session and redirect to index.php
				 $_SESSION['username'] = $user['username'];
				$_SESSION['email'] = $user['email']; // Store email in session
				header('Location: index.php');
				exit();
			} else {
				// If no match, display an error message
				$error = "Invalid username or password.";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
  
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<style type="text/css">
		body {
			background-image: url(images/loginbackg.jpg);
			background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0
		}

		 .container {
            width: 380px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.2); /* Transparent background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            margin-top: 20px;
        }
        .navbar {
    		height: auto; /* Adjust height to accommodate the title */
    		padding: 10px;
		}


		form {
			display: flex;
			flex-direction: column;
			color: red !important;
		}

		.form-group {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 10px;
			opacity: 0.9 !important;
		}

		label {
            color: white; /* Keep label text visible */
            font-weight: bold;
            margin-bottom: 10px;
            margin-right: 10px;
            font-size: 14px;
        }

		input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            box-shadow: none;
            background-color: rgba(255, 255, 255, 1); /* Fully visible input fields */
        }

        .btnlogin {
        	background-color:  darkred !important;
        	color: white;
        	cursor: pointer;
        	padding: auto;
        	text-align: center;
        	font-weight: bold;
        }

        .btnlogin:hover {
        	background-color: red !important;
        	color: black;
        }

		.error {
			color: red;
			text-align: center;
			margin-bottom: 10px;
		}

		.topnav {
		  overflow: hidden;
		  background-color: #333;
		  color: White;
		  padding: auto;

		}


		footer {
			background-color: transparent;
			padding: 10px 0;
			text-align: center;
		}
	</style>
</head>

<body>

	<!--- Custom Top Nav for this specific page -->

	<nav class="blue-grey darken-4">
    <div class="topnav">
        <div class="center">
        <h4> <b> Loans App </b></h4>
        </div>
    </div>
	</nav>
	<!--- End of Custom Top Nav -->


	<div class="center"> <h4> <b>Admin Login</b> </h4> </div>

	<div class="container">
		<div class="center">
			<form action="" method="POST">
				<?php if ($error): ?>
					<div class="error"><?php echo $error; ?></div>
				<?php endif; ?>
				<div class="form-group white-text">
					<label for="name"> Username: </label>
					<input type="text" name="name" id="name">
				</div>
				
				<div class="form-group white-text">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password">
				</div>
				<input type="submit" name="submit" value="Login" class="btnlogin">
			</form>
		</div>
	</div>

<?php include ('footer.php'); ?>
</body>
</html>
