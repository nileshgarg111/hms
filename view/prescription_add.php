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
			<legend>Prescription Add Form</legend>
			<label for="title">Prescription Title</label>
			<input type="text" name="title" id="title" value="<?php echo !empty($_REQUEST["title"]) ? $_REQUEST["title"] : ''; ?>">
			<font color="red"><?php echo $errors["title"]; ?></font>
			<br>
			<label for="description">Prescription Description</label>
			<input type="description" name="description" id="description" 
			       value="<?php echo !empty($_REQUEST["description"]) ? $_REQUEST["description"] : ''; ?>">
			<font color="red"><?php echo $errors["description"]; ?></font>
			<br>
			<input type="hidden" name="page" value="prescription_add">
			<input type="hidden" name="caller" value="self">
			<input type="submit" value="Save">
		</fieldset>
	</form>
<?php
		}
		else
		{
?>
		<h3>Prescription Saved</h3>
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
