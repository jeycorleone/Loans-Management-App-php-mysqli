<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

    include ('connection.php');

    $sql = 'SELECT * FROM loans'; 

    $query = mysqli_query($conn, $sql);

    $paidloans = mysqli_fetch_assoc($query);


    //Joining two tables users and loans

        $sql = ('SELECT * FROM users INNER JOIN loans ON users.id = loans.userid');

        $result = mysqli_query($conn, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Loans App</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <?php include ('navbar.php'); ?>
    <div class="row">
        <?php include ('sidebar.php'); ?>
        <main class="col s12 m10 l10 main-content">
            
               <h3 class="center"><b>Payments</b></h3>
            
        <div class="container">
            <div class="center">
                <table class="striped white">
                    <tr>
                        <th>user ID:</th>
                        <th>User Name:</th>
                        <th>Amount Paid:</th>
                        <th>Paid On:</th>
                        <th>Update:</th>
                    </tr>

                     <?php while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td> <?php echo($row['id']); ?> </td>
                        <td> <?php echo($row['firstname']); ?> </td>
                        <td> <b><?php echo($row['repaid']); ?></b> </td>
                        <td> <?php echo($row['created_at']); ?> </td>
                        <td> <a href="editpayments.php?id=<?php echo$user['id']; ?> " class="brand-text btn"> Update </a>  </td>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
           
        </main>

    </div>
    <?php include ('footer.php'); ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
