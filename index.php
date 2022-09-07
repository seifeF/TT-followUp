<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login-style.css">
    <title>Network Tracking</title>
    <!-- <link rel="stylesheet" href="style2.css"> -->
</head>

<?php
session_start();
require_once('connection.php'); 

$error;
if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$getUser = "SELECT * FROM user";
	$result = mysqli_query($conn, $getUser);
 
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc()) 
		{
			$userNameDB = $row['username'];
			$hashPassword = $row['password'];
			$userid = $row['id'];
			$userType = $row['userType'];
			$verify = password_verify($password, $hashPassword);
			if($verify && $userNameDB == $username)
			{
				$_SESSION['username'] = $username;
				$_SESSION['userID'] = $userid;
				$_SESSION['userType'] = $userType;
				
				header("location:home.php");
			}else
			{
				$error = "Incorrect Username or Password";
		}
	}
	
	
}
}
?>
<body>
    <main>
        <div class="row">
            <div class="colm-logo">
                <img src="assets/awashLogo.png" alt="Logo">
                <h2 style="color:#ed8c37;margin-left:50px;">Nurturing Like the river.</h2>
            </div>
            <div class="colm-form">
			<h5><?php echo @$error;?></h5>
			<br/>
			<form method="post" action="">
                <div class="form-container">
                    <input name="username" type="text" placeholder="username">
                    <input name="password" type="password" placeholder="Password">
                    <button name="login" class="btn-login">Login</button>
                    
                </div>
				</form>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-contents">
            <small>Company © 2022</small>
        </div>
    </footer>
</body>
</html>