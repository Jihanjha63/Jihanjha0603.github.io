<?php 
	session_start();
	include 'config.php';
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
	</header>
	<div class="section">
		<div class="container">
			<h3>Products Data</h3>
			<div class="box">
				<p><a href="add-product.php">Add Products Data</a></p>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th><a href="data-category.php">Category</a></th>
							<th><a href="product.php">Products Name</a></th>
							<th>Price</th>
							<th>Image</th>
							<th>Status</th>
							<th width="150px">Upload Date</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$images = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
							if(mysqli_num_rows($images) > 0){
							while($row = mysqli_fetch_array($images)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td><?php echo $row['product_name'] ?></td>
							<td>Rp. <?php echo number_format($row['product_price']) ?></td>
							<td><a href="images/<?php echo $row['product_image'] ?>" target="_blank"> <img src="images/<?php echo $row['product_image'] ?>" width="200px"> </a></td>
							<td><?php echo ($row['product_status'] == 0)? 'Out of Stock':'Ready'; ?></td>
							<td><?php echo $row['date_created'] ?></td>
							<td>
								<a href="edit-product.php?id=<?php echo $row['product_id'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Are You Sure to Delete ?')">Delete</a>
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="7">No Data!</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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