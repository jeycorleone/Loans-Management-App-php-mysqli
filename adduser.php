<?php

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
// Include the database connection file
include('connection.php');

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $firstname = sanitize_input($_POST['firstname']);
    $middlename = sanitize_input($_POST['middlename']);
    $lastname = sanitize_input($_POST['lastname']);
    $phone = sanitize_input($_POST['phone']);
    $email = sanitize_input($_POST['email']);
    $gender = sanitize_input($_POST['gender']);
    $dob = sanitize_input($_POST['dob']);
    $idcard = sanitize_input($_POST['idcard']);

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($phone) || empty($email) || empty($gender) || empty($dob) || empty($idcard)) {
        echo "Please fill in all required fields.";
    } else {
        // Validate phone number format
        if (!preg_match('/^\d{10}$/', $phone)) {
            echo "Error: Please enter a valid 10-digit phone number.";
        } else {
            // Check if email, phone, or ID card already exists in the database
            $check_query = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ? OR idcard = ?");
            $check_query->bind_param("sss", $email, $phone, $idcard);
            $check_query->execute();
            $result = $check_query->get_result();

            if ($result->num_rows > 0) {
                // If a record is found, display an error message
                echo "Error: The email, phone number, or ID card is already registered.";
            } else {
                // If no record is found, insert the new user data
                $stmt = $conn->prepare("INSERT INTO users (firstname, middlename, lastname, phone, email, gender, dob, idcard) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $firstname, $middlename, $lastname, $phone, $email, $gender, $dob, $idcard);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "New record created successfully.";
                    header('Location: users.php');
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }

            // Close the check query
            $check_query->close();
        }
    }
}

// Close the database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans App</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="row">
        <?php include 'sidebar.php'; ?>
    <main class="col s12 m10 l10 main-content">
           
                
            <div class="center grey-text">
            	<h3><b>Add User</b></h3>
            	<div class="container">
                    <div class="white center">

            		<form action="adduser.php" method="POST">
    <label>Firstname: </label>
    <input type="text" name="firstname" placeholder="Kim" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>" required> 

    <label>Middlename:</label> 
    <input type="text" name="middlename" placeholder="Jon" value="<?php echo isset($_POST['middlename']) ? htmlspecialchars($_POST['middlename']) : ''; ?>"> 

    <label>Lastname:</label> 
    <input type="text" name="lastname" placeholder="Un" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>" required> 

    <label>Phone No:</label> 
    <input type="number" name="phone" placeholder="0711223344" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required> 

    <label>Email:</label> 
    <input type="email" name="email" placeholder="kimjon@123.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required> 

    <label><b>Gender: </b></label> </br>
   <label> <input type="radio" id="Male" name="gender" value="Male"<?php echo isset($_POST['gender']) && $_POST['gender'] == 'Male' ? 'checked' : ''; ?>> <span> Male </span> </label>
   <label> <input type="radio" id="Female" name="gender" value="Female" <?php echo isset($_POST['gender']) && $_POST['gender'] == 'Female' ? 'checked' : ''; ?>> <span> Female </span> </label> <br>

    <br> <label>Date of Birth:</label> 
    <input type="date" name="dob" placeholder="1999" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>" required> 

    <label>ID No.:</label> 
    <input type="number" name="idcard" placeholder="32222222" value="<?php echo isset($_POST['idcard']) ? htmlspecialchars($_POST['idcard']) : ''; ?>" required> 

    <input type="submit" name="submit" value="Submit" class="brand-logo btn">
</form>


            	</div>
                </div>
            </div>
        
    </main>
    </div>
    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
