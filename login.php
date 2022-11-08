<?php
	session_start();
	require "config.php";
	if(isset($_POST['submit'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE username='$user'");
		$result = mysqli_fetch_assoc($query);
		$username = $result['username'];
		if(password_verify($pass,$result['password'])){
			$_SESSION['status_login'] = true; 
			echo '<script>window.location="index.php"</script>';
		} else {
			echo "<script>
				alert('Username dan Password salah');
			</script>";
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
	</div>
</body>
</html>