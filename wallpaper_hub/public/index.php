<?php require_once('../includes/includes_all.php');  ?>
<?php
	$qry="select * from tblimages order by id desc limit 5";
	$photos=Photograph::find_by_sql($qry);
?>
<html>
	<head>
		<title>Wallpaper Hub</title>
		<link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
		<script src="javascript/javalib.js"></script>
		<script src="javascript/cycle.js"></script>
		<script type="text/javascript"></script>
	</head>
	<body>
		<div id="main">
		<?php include_layout_template('header.php');?>
		<?php include_layout_template('menu.php');?>
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
			<div id="contents" >
				<div class="photos slideshow" >
				<?php foreach($photos as $photo){ ?>
				<img src="<?php echo $photo->image_path();?>" width="100%" height="100%"/>
				<?php } ?>
				</div>
				<div style="float:left;background-color:#ff9955; color:white; width:36%; border:5px groove silver; height:280px; margin-left:2px; padding:3;">
					<span style="font-family:calibri; font-size:20px;  ">
						Welcome! to the <strong>Wallpaper Hub</strong>. You can download Wallpapers from here. 
						We hava different categories for you.<br/> All are free...
					</span>
				</div>
				<Span style="clear:both;"></span>
			</div>
		<?php include_layout_template('footer.php');?>
		</div>
		<script type="text/javascript">	
			$('.slideshow').cycle();
		</script>
	</body>
</html>