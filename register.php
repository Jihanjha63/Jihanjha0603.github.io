<?php
    require "config.php";
    if(isset($_POST['submit'])){
        $nama 	= ucwords($_POST['nama']);
        $user 	= $_POST['user'];
        $hp 	= $_POST['hp'];
        $email 	= $_POST['email'];
        $alamat = ucwords($_POST['alamat']);
        $password 	= $_POST['password'];
		$password2 	= $_POST['password2'];
        $query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE username='$user'");
        if(mysqli_fetch_assoc($query)){
            echo "<script>
                alert('Username already used!');
            </script>";
        } else {
            if($password == $password2){
                $password = password_hash($password,PASSWORD_DEFAULT);
                $query = mysqli_query($conn,"INSERT INTO tb_admin (admin_name, username, admin_telp, admin_email, admin_address, password)
                                    VALUES ('$nama','$user','$hp', '$email', '$alamat', '$password')");
                if($query){
                 echo "<script>
                        alert('Registeration Successfully!');
                        document.location.href='login.php';
                    </script>";
                } else {
                    echo "<script>
                        alert('Registeration Failed!');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Your password and your confirm password are different!');
                </script>";
            }
        }
    }
?>
<script>
    //alert("Your password and your confirm password are different!");
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Registration</title>
</head>
<body>
<header>
    <div class="container">
		<h1><a href="index.php">JHA COSMETICS</a></h1>
	</div>
</header>
<div class="section">
    <div class="container">
        <h3>Registration</h3>
        <div class="box">
            <form action="" method="POST">
                <label for="nama">Name</label><br>
                <input type="text" name="nama" class="input-control" placeholder="Enter Your Name"><br>
                <label for="user">Username</label><br>
                <input type="text" name="user" class="input-control" placeholder="Enter Username"><br>
                <label for="hp">No Handphone</label><br>
                <input type="text" name="hp" class="input-control" placeholder="Enter Your No Handphone"><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" class="input-control" placeholder="Enter Your Email"><br>
                <label for="alamat">Address</label><br>
                <input type="text" name="alamat" class="input-control" placeholder="Enter Your Address"><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" class="input-control" placeholder="Enter Password"><br>
                <label for="password2">Confirmation Password</label><br>
                <input type="password" name="password2" class="input-control" placeholder="Enter Confirm Password"><br>
                <input type="submit" name="submit" class="btn" value="Registration"><br><br>
            </form>

            <p>Already have an account?
                <a href="login.php">Login</a>
            </p>
        </div>
    </div>  
</div>
</body>
</html>