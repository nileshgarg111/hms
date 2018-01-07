<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
		include_once "menu.php";
?>

<?php
		if($status=="before_submission" or $status=="failure")
		{
?>
	<h3>Please fill up the following form to add new Prescription</h3>
	<form method="post">
		<fieldset>
			<legend>Request to View Prescription Form</legend>
			<label for="title">Prescription ID</label>
			<input type="text" name="pres_id" id="pres_id" value="">
			<font color="red"><?php echo $errors["pres_id"]; ?></font>
			<br>
			<input type="hidden" name="id" value="<?php echo $_SESSION['uid'] ?>">
			<input type="hidden" name="status" value="PENDING">
			<input type="hidden" name="page" value="request_add">
			<input type="hidden" name="caller" value="self">
			<input type="submit" value="Save">
		</fieldset>
	</form>
<?php
		}
		else
		{
?>
		<h3>Request Sent</h3>
<?php
		}
	}
	else
	{
		$before_login=true;
		include_once "menu.php";
?>
<h3>Invalid Login!!! Try Again.</h3>
<?php
	}
	include_once "footer.php";
?>
