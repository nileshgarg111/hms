<?php 
	include_once "header.php";
	$before_login=true;
	include_once "menu.php";
?>

<?php
	if($status=="before_submission" or $status=="failure")
	{
?>
	<h3>Please fill up the following form to register yourself</h3>
	<form method="post">
		<fieldset>
			<legend>Registration Form</legend>
			<label for="name">Name</label>
			<input type="text" name="name" id="name" value="<?php echo $_REQUEST["name"]; ?>">
			<font color="red"><?php echo $errors["name"]; ?></font>
			<br>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?php echo $_REQUEST["username"]; ?>">
			<font color="red"><?php echo $errors["username"]; ?></font>
			<br>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
			<font color="red"><?php echo $errors["password"]; ?></font>
			<br>
			<label for="user_type">User Type</label>
			<select name="user_type" id="user_type">
			  <option value="">Select...</option>
			  <option value="1">Patient</option>
			  <option value="2">Pharmacist</option>
			  <option value="3">Doctor</option>
			</select>
			<br>
			<input type="hidden" name="page" value="register">
			<input type="hidden" name="caller" value="self">
			<input type="submit" value="Sign Up">
		</fieldset>
	</form>
<?php
	}
	else
	{
?>
		<h3>Registration Successful</h3>
<?php
	}
?>

<?php
	include_once "footer.php";
?>
