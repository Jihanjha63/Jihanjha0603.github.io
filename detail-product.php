<?php 
	error_reporting(0);
	include 'config.php';
	$images = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($images);
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
			<ul>
				<li><a href="product.php">Product</a></li>
			</ul>
		</div>
	</header>

	<div class="search">
		<div class="container">
			<form action="product.php">
				<input type="text" name="search" placeholder="Search Product" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Search Product">
			</form>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<h3>Detail Product</h3>
			<div class="box">
				<div class="col-2">
					<img src="images/<?php echo $p->product_image ?>" width="100%">
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<p>Description :<br>
						<?php echo $p->product_description ?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<small>Copyright &copy; 2022 - JHA Cosmetics</small>
		</div>
	</div>
</body>
</html>