<?php 
    include ('connection.php');
    include ('navbar.php');


    session_start();


        if (isset($_POST['delete'])) {
                
                $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

                $sql = "DELETE FROM users WHERE id = $id_to_delete";

                if (mysqli_query($conn, $sql)) {
                    // success...
                    echo "user Account Delete success";
                    header('Location: users.php');
                } else {
                    // error
                    echo "Account Delete Error: " . mysqli_error($conn);
                }
            }

        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            $sql = "SELECT * FROM users WHERE id = $id";

            $result = mysqli_query($conn, $sql);

            $user = mysqli_fetch_assoc ($result);

             //print_r($user);

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


<div class="row">
<?php include ('sidebar.php'); ?>
    <main class="col s12 m10 l10 main-content">     
           
     <div> <h2><b>User Details </b> </h2> </div>


     <table>
         <tr>
            <th>  <h4> <b> User Profile </b></h4></th>
             <th> <h4> <b> Acc Details </b></h4></th>
         </tr>

         <tr>
             <td><img class="circle" src="images\maleicon.png" alt="User Image"></td>
             <td>
                    <h4> <b> Full Name: <?php echo htmlspecialchars($user['firstname']); ?> 
            <?php echo htmlspecialchars($user['middlename']); ?> 
            <?php echo htmlspecialchars($user['lastname']); ?> </b></h4>
          <h4>Phone Number: <?php echo htmlspecialchars($user['phone']); ?> </h4>
          <h4>Email Address: <?php echo htmlspecialchars($user['email']); ?> </h4>
          <h4>ID Card No.: <?php echo htmlspecialchars($user['idcard']); ?> </h4>
          <h4>Date of Birth: <?php echo htmlspecialchars($user['dob']); ?> </h4>
          <h4>Gender: <?php echo htmlspecialchars($user['gender']); ?> </h4>
          <h4>Acc Created at: <?php echo date($user['created_at']); ?> </h4>


             </td>
         </tr>
     </table>
     <div class="center">
         <a href="edituser.php?id=<?php echo$user['id']; ?> " class="brand-text btn"> Edit/Update </a>
     </div>

            
    </main>
</div>

    <?php include 'footer.php'; ?>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>
