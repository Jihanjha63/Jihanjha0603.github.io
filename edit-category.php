<?php 
	session_start();
	include 'config.php';
	$kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($kategori) == 0){
		echo '<script>window.location="data-category.php"</script>';
	}
	$k = mysqli_fetch_object($kategori);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JHA COSMETICS</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
			<h1><a href="index.php">JHA COSMETICS</a></h1>
		</div>
	</header>
	<div class="section">
		<div class="container">
			<h3>Edit Category Data</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="nama" placeholder="Category Name" class="input-control" value="<?php echo $k->category_name ?>" required>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){

						$nama = ucwords($_POST['nama']);

						$update = mysqli_query($conn, "UPDATE tb_category SET 
												category_name = '".$nama."'
												WHERE category_id = '".$k->category_id."' ");

						if($update){
							echo '<script>alert("Update Data Succesfully!")</script>';
							echo '<script>window.location="data-category.php"</script>';
						}else{
							echo 'Failed '.mysqli_error($conn);
						}

					}
				?>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<small>Copyright &copy; 2022 - JHA Cosmetics</small>
		</div>
	</footer>
</body>
</html>