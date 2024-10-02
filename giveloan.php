<?php 
session_start(); 
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
require 'connection.php'; // Include database connection

// Fetch users for the dropdown
$sql = "SELECT id, firstname, lastname FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans App - Give Loan</title>
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
                <div class="col s12 m10">
                    <h2><b>Give Loan</b></h2>
                    <form class="white" method="POST" action="" onsubmit="calculateLoan(event)">
                        <label>User ID</label>
                        <select name="userid" required>
                            <option value="" disabled selected>Select User ID</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['firstname'] . " " . $row['lastname'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No users found</option>";
                            }
                            ?>
                        </select>

                        <label>Loan Amount</label>
                        <input type="number" name="loan_amount" placeholder="1000" required id="loanAmount"> 

                        <label>Repayment Duration (Months)</label>
                        <input type="number" name="repay_period" placeholder="Time in Months" required id="repayPeriod">

                        <label>Interest Rate (%)</label>
                        <input type="text" name="percentage" placeholder="Percentage%" required id="interestRate">

                        <br>
                        <input type="submit" name="calculate" value="Calculate" class="btn">
                        <br> 
                        <label>Total Repayment</label> 
                        <input type="text" name="repay_amount" readonly value="0.00" id="totalRepayment">
                        <button type="submit" name="submit2" class="btn">Submit</button>
                    </form>
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
