<?php 
	session_start();
	include 'config.php';
	$images = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($images) == 0){
		echo '<script>window.location="data-product.php"</script>';
	}
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
	<!-- <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script> -->
</head>
<body>
	<header>
		<div class="container">
			<h1><a href="index.php">JHA COSMETICS</a></h1>
		</div>
	</header>
	<div class="section">
		<div class="container">
			<h3>Edit Product Data</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="kategori" required>
						<option value="">--Select--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){
						?>
						<option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>
					<input type="text" name="nama" class="input-control" placeholder="Product Name" value="<?php echo $p->product_name ?>" required>
					<input type="text" name="harga" class="input-control" placeholder="Price" value="<?php echo $p->product_price ?>" required>
					
					<img src="images/<?php echo $p->product_image ?>" width="100px">
					<input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
					<input type="file" name="gambar" class="input-control">
					<textarea class="input-control" name="deskripsi" placeholder="Description"><?php echo $p->product_description ?></textarea><br>
					<select class="input-control" name="status">
						<option value="">--Select--</option>
						<option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Ready</option>
						<option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Out of Stock</option>
					</select>
					<input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php
					if(isset($_POST['submit'])){
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];
						$foto 	 	= $_POST['foto'];

						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

				
						if($filename != ''){
							$type1 = explode('.', $filename);
							$type2 = $type1[1];

							$newname = 'images'.time().'.'.$type2;

							$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

							if(!in_array($type2, $tipe_diizinkan)){
								echo '<script>alert("File format not allowed!")</scrtip>';

							}else{
								unlink('./images/'.$foto);
								move_uploaded_file($tmp_name, './images/'.$newname);
								$namagambar = $newname;
							}

						}else{
							$namagambar = $foto;
							
						}
						$update = mysqli_query($conn, "UPDATE tb_product SET 
												category_id = '".$kategori."',
												product_name = '".$nama."',
												product_price = '".$harga."',
												product_description = '".$deskripsi."',
												product_image = '".$namagambar."',
												product_status = '".$status."'
												WHERE product_id = '".$p->product_id."'	");
						if($update){
							echo '<script>alert("Update Data Succesfully!")</script>';
							echo '<script>window.location="data-product.php"</script>';
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
	<script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>