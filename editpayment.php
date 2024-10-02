<?php 
    include ('connection.php');
    session_start();

    // Initialize loan variable to store the loan details
    $loan = null;

    // Fetch the loan details from the database if 'id' is provided via GET
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        // Fetch loan details for the provided ID
        $sql = "SELECT * FROM loans WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // If a matching loan is found, store it in the $loan variable
            $loan = mysqli_fetch_assoc($result);
        } else {
            // Redirect back to payments.php if no loan found
            header('Location: payments.php');
            exit();
        }
    } else {
        // Redirect to payments.php if no 'id' is provided in the GET request
        header('Location: payments.php');
        exit();
    }

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Fetch the loan id from the hidden form input to ensure consistency
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $repaid = mysqli_real_escape_string($conn, $_POST['repaid']);

        // Validate that the 'repaid' amount is provided
        if (empty($repaid)) {
            echo "Please enter the repayment amount.";
        } else {
            // Update the 'repaid' column for the given loan id
            $sql = "UPDATE loans SET repaid='$repaid' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                // Redirect to payments.php after successful update
                header('Location: payments.php');
                exit();
            } else {
                echo "Error updating repayment: " . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Loan Repayment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>

<div class="row">
    <?php include ('sidebar.php'); ?>
    <main class="col s12 m10 l10 main-content">     
        <div class="center">
            <h2><b>Update Loan Repayment</b></h2>
        </div>

        <?php if ($loan): ?>
            <form action="" method="POST">
                <!-- Hidden input to pass the loan ID to the POST request -->
                <input type="hidden" name="id" value="<?php echo $loan['id']; ?>">

                <div class="input-field">
                    <label for="repaid">Amount Paid:</label>
                    <input type="number" name="repaid" value="<?php echo htmlspecialchars($loan['repaid']); ?>" required>
                </div>

                <div class="center">
                    <input type="submit" name="submit" value="Update" class="btn">
                </div>
            </form>
        <?php else: ?>
            <p>No loan details found.</p>
        <?php endif; ?>

    </main>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="custom.js"></script>
</body>
</html>
