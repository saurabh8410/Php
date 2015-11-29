<?php require_once('../includes/includes_all.php');  ?>
<?php
	$cat=!empty($_GET['cat'])?(int)$_GET['cat']:1;
	
	$qry="select * from tblimages where cat_id={$cat}";
	$photos=Photograph::find_by_sql($qry);
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
		<title>Wallpaper Hub</title>
	</head>
	<body>
		<div id="main">
		<?php include_layout_template('header.php');?>
		<?php include_layout_template('menu.php');?>
			<div id="contents" >
				<div style="width:99%; padding:5px;" >
				<?php if($session->is_logged_in()){ ?>
				<?php foreach($photos as $photo){ ?>
				<a href="<?php echo $photo->image_path();?>"><img border="2" src="<?php echo $photo->image_path();?>" width="350" height="300"/></a>
				<?php } 
				}else{ ?>
				<?php foreach($photos as $photo){ ?>
				<img border="2" src="<?php echo $photo->image_path();?>" width="350" height="300"/>
				<?php } }?>
				</div>
				
			</div>
		<?php include_layout_template('footer.php');?>
		</div>
		<script language="javascript">
			var chkuser='<?php echo $session->is_logged_in(); ?>';
			var login=document.getElementById('login');
			var sign_up=document.getElementById('sign_up');
			var user_name=document.getElementById('user_name');
			var logout=document.getElementById('logout');
			if(chkuser=='1'){
				user_name.style.display="inline";
				user_name.innerHTML='<?php echo $_SESSION['user_name']; ?>';
				logout.style.display="inline";
				login.style.display="none";
				sign_up.style.display="none";
			}
		</script>
	</body>
</html>