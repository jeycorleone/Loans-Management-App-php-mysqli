<?php 


 ?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>


<div class="col s12 m2 l2">
    <ul id="slide-out" class="sidenav sidenav-fixed grey darken-4">
        <!-- User Section -->
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="images\moneybg2.jpeg" alt="Background Image">
                </div>
                <a href="#user"><img class="circle" src="images\maleicon.png" alt="User Image"></a>
                <a href="#name"><span class="white-text name"><b>Hello,</b> <?php echo($_SESSION['username']); ?> </span></a>
                <a href="#email"><span class="white-text email"><?php echo($_SESSION['email']); ?></span></a>
            </div>
              <div class="red-text center">
                <a href="index.php"> <i class="material-icons" style="color:red;">dashboard</i> <h7><b> Dashboard </b> </h7></a>
             </div>

        </li>
        <div class="menuset">
       <!-- <li><a href="dashboard.php"><i class="material-icons">dashboard</i>Dashboard</a></li> -->
        <li><a href="loans.php"><i class="material-icons" style="color:darkred"> account_balance</i>Loans</a></li>
        <li><a href="users.php"><i class="material-icons" style="color:darkred">group</i>Users</a></li>
        <li><a href="payments.php"><i class="material-icons" style="color:darkred">payment</i>Payments</a></li>
        <li><a href="settings.php"><i class="material-icons" style="color:darkred">settings</i>Settings</a></li>
        <li><a href="loancalc.php"><i class="material-icons" style="color:darkred"> account_balance</i>Loan Calculator</a></li>
        
        </div>

   
         <li><a href="logout.php"><i class="fa fa-sign-out" style="font-size:24px; color:darkred"></i>Logout</a></li>
    </ul>

</div>

