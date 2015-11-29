<?php require_once('../includes/includes_all.php');
	$message="";
	$username="";
	$password="";
	if ($session->is_logged_in()) { redirect_to("index.php");}
	if(isset($_POST['submit'])){
		$username=trim($_POST["username"]);
		$password=trim($_POST["password"]);
		$found_user=User::authenticate($username,$password);
		if(!empty($found_user)){
			$session->login($found_user);
			redirect_to("index.php");
		}else{
			$message="Invalid User Name or Password";
			$username="";
			$password="";
		}
	}	
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
			<div id="contents">
				 <center>
					<img src="images/account/img_1.png" width="150" height="150">
					<form action="login.php" method="Post">
					<table>
					<tr>
						<td>Username</td>
						<td><input type="text" autofocus name="username"/></td>
					</tr>
					<tr>
						<td>Password </td>
						<td><input type="password" autofocus name="password"/></td>
					</tr> 
					<tr>
						<td colspan="2" align="right"><input type="submit" name="submit" value="Login"/> </td>
					</tr> 
				</table>
				<?php echo output_msg($message); ?>
			</form>
			<h4><a href="SignUp.php">Not having Account..</a></h4>
				</center>
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
		<?php include_layout_template('footer.php');?>
		</div>
	</body>
</html>