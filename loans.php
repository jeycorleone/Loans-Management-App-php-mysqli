<?php 

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
    
    
    include('connection.php');

             $sql= 'SELECT * FROM loans';

            //Make query and get result
            $result= mysqli_query($conn, $sql);

            //fetch resulting rows as an array
            $loans= mysqli_fetch_all($result, MYSQLI_ASSOC);
 
            //print_r($loan);

        //Joining two tables users and loans

        $sql = ('SELECT * FROM users INNER JOIN loans ON users.id = loans.userid');

        $result = mysqli_query($conn, $sql);

       // $outp = mysqli_fetch_assoc($result);

       // print_r($outp);
 

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
        <?php include 'sidebar.php';?>


    <main class="col s12 m10 l10 main-content">
           
                <div class=" ">
                    <h2> <b> Loan Metrics </b> </h2>
                </div>

                 <div id="chartContainer" style="height: 360px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

                <div class="center">


        <!--- Total loans paid and balance query here -->
        <?php 

    $sql = "SELECT SUM(loan_amount) AS sum FROM loans";

     $query = mysqli_query($conn, $sql);

     while ($row = mysqli_fetch_assoc($query)) {
         $ttloans = $row['sum'];
     }


     $sql = "SELECT SUM(repaid) AS sum FROM loans";

     $query = mysqli_query($conn, $sql);

     while ($row = mysqli_fetch_assoc($query)) {
         $ttrepaid = $row['sum'];
     }

      $unpaidLoans = $ttloans - $ttrepaid; 

      // Calculate the percentage of repaid loans
        $repaidPercentage = ($ttrepaid / $ttloans) * 100;

        // Calculate the percentage of unpaid loans
        $unpaidPercentage = ($unpaidLoans / $ttloans) * 100;                          
        ?>
         <!--- Total loans paid and balance query End -->

<!--- Table 1 with 3 cols 1 row starts here -->
<div class="center">
    <table>
        <tr>
            <th>Total Loaned</th>
            <th>Repaid Amt</th>
            <th>Unpaid Amt</th>
        </tr>
        <tr>
            <td> <?php echo number_format($ttloans); ?> </td>
            <td> <?php echo number_format($ttrepaid); ?> </td>
            <td> <b><?php echo number_format($unpaidLoans); ?></b> </td>
      
        </tr>
    </table>
</div>
<!--- Table 1 with 3 cols 1 row End -->
 

<!--- Table 2 with All Loans starts here -->
<h3 class="center"> <b>Loaned </b></h3>
        <div class="white">
        <table class="striped">
            <tr>
                <th>user ID:</th>
                 <th>user Name:</th>
                 <th>Contact:</th>
                 <th>Loan Amount:</th>
                <th>Repaid:</th>
                <th>Balance:</th>
                <th>Issued On:</th>
            </tr>

        <?php while ($row = $result->fetch_assoc()) : 

            ?>

            <tr>
                <td><?php echo($row['userid']) ?></td>
                <td><?php echo($row['firstname']); ?></td>
                <td><?php echo($row['phone']); ?></td>
                <td><?php echo number_format($row['loan_amount'], 2); ?></td>
                <td><?php echo number_format($row['repaid'], 2); ?></td>
                <td><b><?php echo number_format($row['loan_amount'] - $row['repaid'], 2); ?></b></td>
                <td><?php echo($row['created_at']); ?></td>
              
            </tr>

        <?php endwhile; ?>
        </table>
        </div>
    <!--- Table 2 all loans End -->


    <!--- Pie Chart start -->
                <?php
 
                $dataPoints = array( 
                    array("label"=>"Repaid Loans", "y"=>$repaidPercentage),
                    array("label"=>"Pending Loans", "y"=>$unpaidPercentage),
                   
                )
                 
                ?>


                                <script>
                window.onload = function() {
                 
                 
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Usage Share of given Loans"
                    },
                    subtitles: [{
                        text: " <?php echo(date('d-m-Y')) ?> "
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00\"%\"",
                        indexLabel: "{label} ({y})",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();
                 
                }
                </script>

                </div>

                <div class="center">
                    </br>
                    </br>
                </div>

       <div class="container">
        <div class="grey-text center">
            <div class="white">



            </div>
        </div>
        </div>
 
            
    </main>
    </div>


   

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>

     <?php include 'footer.php'; ?>
</body>
</html>
