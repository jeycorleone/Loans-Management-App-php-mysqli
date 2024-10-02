<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

include ('connection.php');
include ('navbar.php');


if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT * FROM loans WHERE id = $id";

            $result = mysqli_query($conn, $sql);

            $loan = mysqli_fetch_assoc ($result);

            //print_r($loan);

        }


 ?>



<div class="row">
        <?php include ('sidebar.php'); ?>
        <main class="col s12 m10 l10 main-content">
            
                <h2> <b>Loan Details </b></h2>

                 
           
        </main>

    </div>
 
 <body>
 


 </body>
 </html>
  <?php include ('footer.php'); ?>