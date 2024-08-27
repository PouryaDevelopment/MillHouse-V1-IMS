<?php
	//I am going to start a session so i can store data between different files
	session_start();
	if(isset($_SESSION['IMS_user'])) header('Location: dashboard.php'); //If you have already logged in and accidently leave the dashboard, by entering the login page it will immediatly redirect you to the dashboard since you have already logged in and havent ended the user session by loggin out.




	$sql_connection_error = '';  
if($_POST){ //we have to use POST and not GET since it wont be safe for the data.
	include('dbs/connection2data.php'); // connection to the user database


	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="' . $password . '"' ; 											//mysql query
	$runveri = $connection->prepare($query);
	$runveri-> execute();



	if($runveri->rowCount() > 0) {
	$runveri->setFetchMode(PDO::FETCH_ASSOC);
	$client = $runveri->fetchAll()[0];					//verification for mysql
	$_SESSION['IMS_user'] = $client;

	
	header('Location: dashboard.php');
	} else $sql_connection_error = 'Wrong login details!'; //error prompt for wrong login details
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mill House IMS Login</title>

	<link rel="stylesheet" type="text/css" href="cssp1/loginpage.css">
</head>
<body id="nbody">
	<?php if(!empty($sql_connection_error)) { ?>
	<div id="MYSQLError">
		<p>MYSQL Error: <?= $sql_connection_error ?> </p>
	</div>
<?php } ?>
 <div class="container">
 	<div class="loginbanner">
 		<h1>MILLHOUSE</h1>
 		<p>LOG IN</p>
 	</div>
 	<div class="loginform">
 		<form action="login.php" method="POST">
 			<div class="loginforminput">
 				<label for="">Username</label>
 				<input placeholder="username" name="username" type="text" />
 			</div>
 			<div class="loginforminput">
 				<label for="">Password</label>
 				<input placeholder="password" name="password" type="password" />
 			</div>
 			<div class="loginbutton">
 				<button>Request Entry</button>
 			</div>
 		</form>
 	</div>
 </div>
</body>
</html>