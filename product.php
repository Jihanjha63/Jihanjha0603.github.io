  <?php 
	error_reporting(0);
	include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JHA COSMETICS</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="container">
			<h1><a href="index.php">JHA COSMETICS</a></h1>
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
			<h3>Ready Product</h3>
			<div class="box">
				<?php 
					if($_GET['search'] != '' || $_GET['kat'] != ''){
						$where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
					}

					$images = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
					if(mysqli_num_rows($images) > 0){
						while($p = mysqli_fetch_array($images)){
				?>
					<a href="detail-product.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="images/<?php echo $p['product_image'] ?>">
						</div>
					</a>
				<?php }}else{ ?>
					<p>No Product Data!</p>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<small>Copyright &copy; 2021 - JHA Cosmetics</small>
		</div>
	</div>
</body>
</html>