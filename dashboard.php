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
                            <div class="box-footer">
                                <span class="footer-text">1025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="card-panel box">
                            <div class="box-header">
                                <span class="user-name">Pending Loans</span>
                            </div>
                            <div class="box-footer">
                                <span class="footer-text">7,456,258</span>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="card-panel box">
                            <div class="box-header">
                                <span class="user-name">Total Loans</span>
                            </div>
                            <div class="box-footer">
                                <span class="footer-text">14,675,589</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Rest of the Content -->
                <div class="section">
                    <h4>Dashboard</h4>
                    <p>Manage your loans and payments from this dashboard.</p>
                </div>

            <!-- Start of chart -->

                <!DOCTYPE HTML>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "Clientelle Growth"
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

            <!--start of pie chart-->




            <!--End of Pie chart-->


        </main>
    </div>
    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
