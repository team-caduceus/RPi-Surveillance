<?php include 'header.php'; ?>

<?php 
if(isset($_POST) && !empty($_POST))
{
session_start();
include("config.php"); //including config.php in our file
$username = mysql_real_escape_string(stripslashes($_POST['username'])); //Storing username in $username variable.
$password = mysql_real_escape_string(stripslashes(md5($_POST['password']))); //Storing password in $password variable.


$match = "select id from $table where username = '".$username."' and password = '".$password."';"; 

$qry = mysql_query($match);

$num_rows = mysql_num_rows($qry); 

if ($num_rows <= 0) { 

echo "<div id='loginwrap'><div class='loginheader'>";
echo "<h2>RPI Surveillance</h2>";
echo "<p>Login error!</p><p>Sorry, there is no username $username with the specified password.</p>";

echo "<br /><br /><a href='index.php'>Try again</a>";
echo "</div></div>";


} else {

$_SESSION['user']= $_POST["username"];
header("location:stream.php");
// It is the page where you want to redirect user after login.
}
}else{
?>

	<div id="loginwrap">
	<div class="loginheader">
	<h2>RPI Surveillance</h2>
	</div>
	<div class="loginentry">
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-signin" id = "login_form" >
	<input class="login-in" type="text" name="username" size="25" placeholder="Username">
	<input class="login-in" type="password" name="password" size="25" placeholder="Password"><br />
	<input class="login-bu" type="submit" value="Log In" class="btn btn-large btn-primary">   
	</form>
	</div>
	</div>
	
<?php include 'footer.php'; ?>
<?php
}
?>