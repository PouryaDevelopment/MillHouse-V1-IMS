<?php
session_start();
if(isset($_SESSION['IMS_user'])) header('Location: dashboard.php'); // Redirect the user if already logged in.

$sql_connection_error = '';  
if($_POST){
    include('dbs/connection2data.php'); // Connection to our application database

    $username = $_POST['username'];             //posts my inputs
    $password = $_POST['password'];

    $query = 'SELECT * FROM users WHERE email = :username AND password = :password'; 
    $runveri = $connection->prepare($query);
    $runveri->bindParam(':username', $username); // 
    $runveri->bindParam(':password', $password); // This binds the username password parameter.
    $runveri->execute();

    if($runveri->rowCount() > 0) {
        $runveri->setFetchMode(PDO::FETCH_ASSOC);
        $client = $runveri->fetch(); 
        $_SESSION['IMS_user'] = $client; 
        $_SESSION['IMS_user_role'] = $client['role']; // this is for the sidebar to have a variable to ensure logging in with a different role will change the dashboard title

        header('Location: dashboard.php');
    } else {
        $sql_connection_error = 'Wrong login details!'; 
    }
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
