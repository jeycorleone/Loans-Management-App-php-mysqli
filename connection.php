<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "loans_db";
	$conn = new mysqli($servername, $username, $password, $db_name);
	if (!$conn) {
		echo 'Connection Error';
	}
	

	//Write query for all users info
	$sql= 'SELECT * FROM users';

	//Make query and get result
	$result= mysqli_query($conn, $sql);

	//fetch resulting rows as an array
	$users= mysqli_fetch_all($result, MYSQLI_ASSOC);

		

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title></title>
 </head>
 <body>

 <!--Rendering data from DB to the Browser

 <h3> Users are: </h3>

 	<?php 

 		foreach ($users as $user) { ?>
 		
 			
 		<li> <?php echo($user['firstname'] . ' '. $user['lastname'] . '</br>'); ?></li>
 		
	 <?php } ?> 

-->
 
 </body>
 </html>
