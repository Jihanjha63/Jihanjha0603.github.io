<?php
    session_start();
    require 'config.php';
    if(isset($_POST['submit'])){
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $hasil = mysqli_query($conn, "SELECT username, password FROM tb_admin WHERE username = '$user'");
        if(mysqli_num_rows($hasil)== 1){
          $row = mysqli_fetch_assoc($hasil);
          if(password_verify($pass, $row['password'])){
            $_SESSION['status_login'] = $row;

            header("Location: index.php");
          }else{
            $error_pass = true;
          }
        }else{
            $error_username= true;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | JHA COSMETICS</title>
	<link rel="stylesheet" href="css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		<br>
        <p>Don't have an account yet?
                <a href="register.php">Register</a>
        </p>
		<br>
		<?php if (isset($error_pass)) {echo "<h2><a>Your Password is Wrong!</a></h2>";} ?>
    	<?php if (isset($error_username)) {echo "<h2><a>Account Not Found!</a></h2>";} ?>
	</div>
</body>
</html>