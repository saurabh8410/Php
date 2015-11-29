<?php
require_once('../../includes/includes_all.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }

$obj=$database->query("select * from tblcategories");


?>
<?php
	$max_file_size = 10485760;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB
	$message="";
	if(isset($_POST['submit'])) {
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->cat_id = $_POST['cat'];
		$photo->attach_file($_FILES['file_upload']);
		
		if($photo->save()) {
			// Success
      	$message="Photograph uploaded successfully.";
			//redirect_to('list_photos.php');
		} else {
			// Failure
      $message = join("<br />", $photo->errors);
		}
	}
?>
<html>
	<head>
	<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="../stylesheets/style.css"/>
	</head>
	<body>
		<div id="main">
		<?php include_layout_template('header.php');?>
		<h3>Upload Images</h3><hr/>
			<div id="contents">
				<div class="left">
					<?php include("menu.php"); ?>
				</div>
				<div class="right">
                <?php echo output_msg($message); ?>
				<form action="upload_images.php" enctype="multipart/form-data" method="POST">
					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>"
					<p>Select File:<input type="file" name="file_upload" /></p>
					<p>Caption:<input type="text" name="caption"/></p>
					<p>Category:<select name="cat">
					<?php 
						while($cat=$database->fetch_array($obj)){?>
						<option value="<?php echo $cat[0]; ?>"><?php echo $cat[1];?></option>	
						<?php }?>
					</select>
					</p>
					<input type="submit" name="submit" value="Upload"/>
				
					</form>
				</div>
				<div class="clear"></div>
			</div>
		<?php include_layout_template('footer.php');?>
		</div>
	</body>
</html>