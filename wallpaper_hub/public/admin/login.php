<?php require_once('../../includes/includes_all.php');
	$message="";
	$username="";
	$password="";
	if($session->is_logged_in()){
		redirect_to("index.php");
	}
	if(isset($_POST['submit'])){
		$username=trim($_POST["username"]);
		$password=trim($_POST["password"]);
		$found_user=User::authenticate($username,$password);
		echo $found_user;
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
		<link rel="stylesheet" type="text/css" href="../stylesheets/style.css"/>
	</head>
	<body>
		<div id="main">
		<?php include_layout_template('header.php');?>
			<div id="contents">
			<form action="login.php" method="post" >
				<div class="login_form">
				<table width="100%">
					<tr><td>User Name</td></tr>
					<tr>
						<td>
							<input type="text" name="username" size="28" maxlength="15"   />
						</td>
					</tr>
					<tr><td>Password</td></tr>
					<tr>
						<td>
							<input type="password" name="password" size="28" maxlength="15"  />
						</td>
					</tr>
					<tr>
						<td align="right">
							<input type="submit" name="submit" value="Login"/>
						</td>
					</tr>
				</table>
				<?php echo output_msg($message); ?>
				</div>
			</form>
			
			</div>
			<?php include_layout_template('footer.php');?>
		</div>
	</body>
</html>