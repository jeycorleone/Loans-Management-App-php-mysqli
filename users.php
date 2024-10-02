<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header('Location: login.php');
    exit();
}

    include('style2.php');
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
        <?php include 'sidebar.php'; ?>
        <main class="col s12 m10 l10 main-content">
         
         <?php include('connection.php'); ?>

      
        <div class="main1">
    <div class="search-container">
        <a href="adduser.php" class="brand-text btn add-user-btn"> Add User </a>
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search here" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" class="search-input">
            <button type="submit" name="search_btn" class="search-btn">
                <i class="material-icons">search</i>
            </button>
        </form>
    </div>
</div>



        <div class="center white">
            <table class="striped">
                <tr>
                     <th>ID</th>
                     <th>F-NAME</th>
                     <th>L-Name</th>
                     <th>Phone No.</th>
                     <th>Email</th>
                     <th>More Info</th>
                     <th>Delete </th>
                </tr>
                         <?php foreach ($users as $user) : ?>
                <tr>
                    <td> <?php echo($user['id']); ?> </td>
                    <td> <?php echo($user['firstname']); ?> </td>
                    <td> <?php echo($user['lastname']); ?> </td>
                    <td> <?php echo($user['phone']); ?> </td>
                    <td> <?php echo($user['email']); ?> </td>
                    <td> <a href="userdetails.php?id=<?php echo$user['id']; ?> " class="brand-text btn"> Details </a> </td>
                    <td> 
                        <form action="userdetails.php" method="POST">
              <input type="hidden" name="id_to_delete" value=" <?php echo $user['id'] ?> ">
              <input type="submit" name="delete" value="Delete" class="brand-text btn3" onclick="alert('Are you sure to Delete?')">
            </form>
                     </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>


   </main>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
