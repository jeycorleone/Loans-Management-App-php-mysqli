<?php 

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}


    include ('connection.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Loans App</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <main class="col s12 m10 l10 main-content">
           
                <!-- Boxes Section -->
                <div class="row">
                    <div class="col s12 m4 l4">
                        <div class="card-panel box">
                            <div class="box-header">
                                <span class="user-name">Total Users</span>
                            </div>
                            <?php 

                                    $sql = "SELECT id FROM users ORDER BY id";

                                    $query = mysqli_query($conn, $sql);

                                    $usercount = mysqli_num_rows($query);

                                 ?>
                            <div class="box-footer">

                              <span class="footer-text"> <?php echo $usercount ?> </span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="card-panel box">
                            <div class="box-header">
                                <span class="user-name">Total Repaid</span>
                            </div>
                            <div class="box-footer">
                                <?php 

                                    $sql = "SELECT format(SUM(repaid), 'NO') AS sum FROM loans";

                                    $query = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $output = $row['sum'];
                                    }

                                 ?>
                                <span class="footer-text"> <?php echo $output; ?> </span>

                                 

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="card-panel box">
                            <div class="box-header">
                                <span class="user-name">Total Loans</span>
                            </div>
                            <div class="box-footer">
                                <?php 

                                    $sql = "SELECT format(SUM(loan_amount), 'NO') AS sum FROM loans";

                                    $query = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $output = $row['sum'];
                                    }

                                 ?>
                                <span class="footer-text"> <?php echo $output; ?> </span>

                                 

                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rest of the Content -->
                <div class="section">
                    <h4>Graphs</h4>
                    <p>Data graphical representation charts</p>
                </div>

            <!-- Start of chart -->

                <!DOCTYPE HTML>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "Clientele Growth"
    },
    axisY: {
        title: "No. of Clients(MMbbl)"
    },
    data: [{        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "MMbbl = Time in Years",
        dataPoints: [      
            { y: 87, label: "2020" },
            { y: 561, label: "2021" },
            { y: 952, label: "2022" },
            { y: 1523,  label: "2023" },
            { y: 1852,  label: "2024" },
            { y: 2896,  label: "2025" },
          
        ]
    }]
});

   


chart.render();

}
</script>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


            <!--End of chart 1-->


        </main>
    </div>
    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
