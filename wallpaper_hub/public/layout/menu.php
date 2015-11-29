<div class="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><span style="color:orange;">||</span>
		<li><a href="images.php?cat=1">Cartoons</a></li>
		<li><span style="color:orange;">||</span>
		<li><a href="images.php?cat=2">Nature</a></li>
		<li><span style="color:orange;">||</span>
		<li><a href="images.php?cat=3">Games</a></li>
		<li><span style="color:orange;">||</span>
		<li><a href="images.php?cat=4">Movies</a></li>
		
	</ul>
</div>
<div style="text-align:right; padding-top:5px; margin-right:5px; font-size:18px;">
	<a id="login" href="Login.php">Login</a> &nbsp;
	<a id="sign_up" href="SignUp.php">SignUp</a>
	<span style="display:none;" id="user_name">Hello, User</span> &nbsp;
	<a style="display:none;" id="logout" href="#" onclick="log_out();">Logout</a>
</div>
<hr/>
<script>
	function log_out(){
		document.location='logout.php';
	}

</script>
