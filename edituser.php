<?php 
    include ('connection.php');
    include ('navbar.php');
    session_start();

    // Fetch the user details from the database if 'id' is provided
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        // If no user found, redirect back to the users page
        if (!$user) {
            header('Location: users.php');
            exit();
        }
    }

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $dob = mysqli_real_escape_string($conn, $_POST['dob']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $idcard = mysqli_real_escape_string($conn, $_POST['idcard']);

        // Validate inputs
        if (empty($firstname) || empty($lastname) || empty($phone) || empty($email) || empty($dob) || empty($idcard)) {
            echo "Please fill in all required fields.";
        } else {
            // Update user details in the database
            $sql = "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', phone='$phone', email='$email', dob='$dob', gender='$gender', idcard='$idcard' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                echo "User details updated successfully!";
                header('Location: users.php');  // Redirect after successful update
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>

<div class="row">
    <?php include ('sidebar.php'); ?>
    <main class="col s12 m10 l10 main-content">     

        <h2><b>Edit User Details</b></h2>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <div class="input-field">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
            </div>
            
            <div class="input-field">
                <label for="middlename">Middle Name</label>
                <input type="text" name="middlename" value="<?php echo htmlspecialchars($user['middlename']); ?>">
            </div>

            <div class="input-field">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
            </div>

            <div class="input-field">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>

            <div class="input-field">
                <label for="email">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="input-field">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" required>
            </div>

            <div class="input-field">
			    <label for="gender">Gender:</label>
			</br>
			    <p>
			        <label>
			            <input name="gender" type="radio" value="Male" <?php if($user['gender'] == 'Male'){ echo 'checked'; } ?> />
			            <span>Male</span>
			        </label>
			        <label>
			            <input name="gender" type="radio" value="Female" <?php if($user['gender'] == 'Female'){ echo 'checked'; } ?> />
			            <span>Female</span>
			        </label>
			    </p>
			</div>

            <div class="input-field">
                <label for="idcard">ID Card No.</label>
                <input type="text" name="idcard" value="<?php echo htmlspecialchars($user['idcard']); ?>" required>
            </div>

            <div class="center">
                <input type="submit" name="submit" value="Update" class="btn">
            </div>
        </form>

    </main>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="custom.js"></script>
</body>
</html>
