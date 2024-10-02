<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

include ('connection.php');

if (isset($_POST['submit2'])) {
    // Collect form data
    $userid = $_POST['userid'];
    $loan_amount = $_POST['loan_amount'];
    $repay_period = $_POST['repay_period'];
    $percentage = $_POST['percentage'];
    $total_repayment = $_POST['total_repayment']; // This should be calculated

    // Calculate the total repayment
    $repay_amount = $loan_amount + ($loan_amount * ($percentage / 100) * ($repay_period / 12)) + ($loan_amount * 0.05);

    // Validate and sanitize inputs
    if (!empty($userid) && !empty($loan_amount) && !empty($repay_period) && !empty($percentage)) {
        // Insert data into loans table
        $sql = "INSERT INTO loans (userid, loan_amount, pay_duration, interest) 
                VALUES ('$userid', '$total_repayment', '$repay_period', '$percentage')";

        if (mysqli_query($conn, $sql)) {
            echo "Loan granted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "All fields are required!";
    }
}


// Fetch user IDs from the 'users' table
$query = "SELECT id FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans App</title>
    
</head>
<body>

<style type="text/css">
        body {
            background-color: lightgray;
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
        /* The popup form - hidden by default */
        .form-popup {
          display: none;
          position: fixed;
          bottom: 0;
          right: 15px;
          border: 3px solid #f1f1f1;
          z-index: 9;
        }

    </style>

    <?php //include 'navbar.php'; ?>
    <div class="row">
        <?php //include 'sidebar.php'; ?>
        <main class="col s12 m10 l10 main-content">
            <div class="center grey-text">
                <div class="col s12 m10">
                    <h2><b>Give Loan</b></h2>

                    <!-- Loan form -->
                    <div class="container">
                        <div class="center white">

                    <form class="white" method="POST" action="" id="loanForm">
                        <!-- User ID Dropdown (populated from 'users' table) -->
                        <label>User ID</label>
                        <select name="userid" required>
                            <option value="" disabled selected>Select User ID</option>
                            <?php
                                // Loop through each user ID and create a dropdown option
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['id'] . "</option>";
                                }
                            ?>
                        </select>

                        <!-- Loan Amount Field -->
                        <label>Loan Amount</label> 
                        <input type="number" name="loan_amount" placeholder="1000" required id="loanAmount"> 

                        <!-- Repayment Duration Field -->
                        <label>Repayment Duration (Months)</label> 
                        <input type="number" name="repay_period" placeholder="Time in Months" required id="repayPeriod">

                        <!-- Interest Rate Field -->
                        <label>Interest Rate (%)</label> 
                        <input type="number" name="percentage" placeholder="Percentage%" required id="interestRate">

                        <br>

                        <!-- Calculate Button -->
                        <button type="button" onclick="calculateLoan()" class="btn">Calculate</button>
                        <br> 

                        <!-- Total Repayment Field -->
                        <label>Total Repayment</label> 
                        <input type="text" name="total_repayment" readonly value="0.00" id="totalRepayment">

                        <br>

                        <!-- Submit Button -->
                        <button type="submit" name="submit2" class="btn">Submit</button>
                    </form>
                        </div>
                     </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php //include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Custom JavaScript to calculate loan repayment -->
    <script>
        function calculateLoan() {
            // Get the form values
            let loanAmount = parseFloat(document.getElementById('loanAmount').value);
            let repayPeriod = parseFloat(document.getElementById('repayPeriod').value);
            let interestRate = parseFloat(document.getElementById('interestRate').value);

            // Validate form inputs
            if (isNaN(loanAmount) || isNaN(repayPeriod) || isNaN(interestRate)) {
                alert("Please fill in all fields with valid numbers.");
                return;
            }

            // Calculate the total repayment
            let totalRepayment = loanAmount + (loanAmount * (interestRate / 100) * (repayPeriod / 12));

            // Display the total repayment in the input field
            document.getElementById('totalRepayment').value = totalRepayment.toFixed(2);
        }


            function openForm() {
             document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
             document.getElementById("myForm").style.display = "none";
            }

    </script>
</body>
</html>

