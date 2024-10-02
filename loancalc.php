<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

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

    <style type="text/css">
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

    </style>
    <?php include 'navbar.php'; ?>
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <main class="col s12 m10 l10 main-content">
           
               

             <div class="center grey-text">
             	 
             	
             	<div class="col s12 m10">
             		<h2> <b>Simple Loan Calculator </b></h2>
             		
             		<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator</title>
</head>
<body>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Calculator</title>
</head>
<body>

    <form class="white" onsubmit="calculateLoan(event)">
        <label>Loan Amount</label> 
        <input type="number" name="amount" placeholder="1000" required id="loanAmount"> 
        <label>Repayment Duration</label> 
        <input type="number" name="Repay_Period" placeholder="Time in Months" required id="repayPeriod">
        <label>Interest Rate</label> 
        <input type="text" name="percentage" placeholder="Percentage%" required id="interestRate">
        <br>
        <input type="submit" name="submit" value="Calculate" class="btn">
        <br> 
        <label>Total Repayment</label> 
        <input type="text" name="Repay_Amount" readonly value="0.00" id="totalRepayment">
    </form>

    <script>
        function calculateLoan(event) {
            event.preventDefault();

            const loanAmount = parseFloat(document.getElementById('loanAmount').value);
            const repayPeriod = parseFloat(document.getElementById('repayPeriod').value);
            const interestRate = parseFloat(document.getElementById('interestRate').value);

            if (isNaN(interestRate) || interestRate < 0) {
                alert("Please enter a valid interest rate.");
                return;
            }

            // Simple interest formula: Total Repayment = Loan Amount + (Loan Amount * Interest Rate * Repayment Period)
            const totalRepayment = loanAmount + (loanAmount * (interestRate / 100) * (repayPeriod / 12));

            document.getElementById('totalRepayment').value = totalRepayment.toFixed(2);
        }
    </script>


     <button class="open-button" onclick="openForm()">Open Form</button>
                    <div class="form-popup" id="myForm">

                         <!-- Loan form -->
                    <div class="container">
                        <div class="center white">

                    <form class="white" method="POST" action="try.php" id="loanForm">
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


</body>
</html>


</body>
</html>


             	</div>

             </div>
           
            
        </main>
    </div>


    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
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


    <!-- form2 -->



<!-- End of form2 -->

</body>
</html>
