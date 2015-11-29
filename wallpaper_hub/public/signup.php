<?php require_once('../includes/includes_all.php');  
if ($session->is_logged_in()) { redirect_to("index.php");}
	$message="";
	$uname="";
	$pass="";
	$fname="";
	$lname="";
	$gender="";
	$mail="";
	$mob="";
	if(isset($_POST['submit'])){
		$uname=trim($_POST["uname"]);
		$pass=trim($_POST["pass"]);
		$fname=trim($_POST["fname"]);
		$lname=trim($_POST["lname"]);
		$gender=trim($_POST["gender"]);
		$mail=trim($_POST["mail"]);
		$mob=trim($_POST["mob"]);
		
		$user_create=User::create_user($fname,$lname,$gender,$mail,$mob,$uname,$pass);
		if($user_create){
			$message="Sucessfully signup";
			//redirect_to("index.php");
		}else{
			$message="User name already exist";
			//echo "nahi gaya";
		}
	}

?>
<html>
<head>
	<title>Signup</title>
	<script language="javascript">
	function validate(){
		if(isNaN(mob.value))
		{
			mob.value="";
			alert("Only Numbers");
		}
		else if(mob.value.length==10)
		{
			mob.value="";
			alert("Should be of 10 digits");
		}
	}
</script>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css"/>
</head>
<body>
<div id="main">
		<?php include_layout_template('header.php');?>
		<?php include_layout_template('menu.php');?>
	<div id="contents">
	<div style="float:left; padding:3px;">
	<img id="img" src="images/account/img_2.png" width="700px" height="420px">
	</div>
      <div style="float:left; margin-left:20px;">
		<sup >*</sup><font color="red">Mandatory fields - Can not be left empty..</font>
		<form action="signup.php" method="Post">
		<table class="signup" border="0">
        <tr><td>First Name<sup>*</sup></td><td><input required type="text" name="fname" autofocus class="txtbox"/></td></tr>
		<tr><td>Last Name</td><td><input type="text" required name="lname" class="txtbox"/></td></tr> 
		<tr><td>Gender </td><td><select name="gender" class="txtbox"><option/>Male<option/>Female</select></td></tr>
		<tr><td>E-mail<sup>*</sup></td><td><input name="mail" required type="email" class="txtbox"/></td></tr>
		<tr><td>Mobile Number</td><td><input type="text" onKeyUp="validate()" required id="mob" class="txtbox"/></td></tr>
		<tr><td>User-Name<sup>*</sup> </td><td><input type="text" required  name="uname"class="txtbox"/></td></tr>
		<tr><td>Password<sup>*</sup> </td><td><input type="password" required name="pass" class="txtbox"></td></tr>
		<tr>
		<td align="center" colspan="2">
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="submit" name="submit" value="Confirm" OnClick="validation()"/>
		  &nbsp;&nbsp;<input type="reset" id="b1"/>
		</td>
		</tr>
		<tr>
			<td colspan="2"><?php echo output_msg($message); ?></td>
		</tr>
		</table>
		</form>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php include_layout_template('footer.php');?>
</div>
</body>
</html>