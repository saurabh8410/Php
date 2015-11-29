<?php
	require_once("../../includes/includes_all.php");
	if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$photos=Photograph::find_all();//static function for retrieve all photos
?>
<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="../stylesheets/style.css"/>
	</head>
	<body>
		<div id="main">
		<?php include_layout_template('header.php'); ?>
		<h3>Home</h3><hr/>
			<div id="contents">
				<div class="left">
					<?php include("menu.php"); ?>
				</div>
				<div class="right">
					<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th>Image</th>
							<th>File Name</th>
							<th>Caption</th>
							<th>Size</th>
							<th>Type</th>
							<th>Delete</th>
						</tr>
						<?php foreach($photos as $photo){ ?>
						<tr>
							<td><img src="../<?php echo $photo->image_path();?>" width="100"/></td>
							<td><?php echo $photo->file_name; ?></td>
							<td><?php echo $photo->caption; ?></td>
							<td><?php echo $photo->size>1024 ? round($photo->size/1024)." KB" :
								$photo->size." bytes"; ?>
							</td>
							<td><?php echo $photo->type; ?></td>
							<td><a href="images_list.php?delete=<?php echo $photo->id; ?>">Delete</a></td>
						</tr>
						<?php } ?>
					</table>
					<br/>
					<a href="upload_images.php">Upload Image</a>
				</div>
				<div class="clear"></div>
			</div>
		<?php include_layout_template('footer.php');?>
		</div>
	</body>
</html>