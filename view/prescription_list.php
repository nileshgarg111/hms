<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
		include_once "menu.php";
?>

		<table border="1" width="50%" align="center">
			<tr>
				<th>Title</th>
				<th>Details</th>
			</tr>
<?php
		foreach($prescriptions as $prescription)
		{
?>
			<tr>
				<td><?php echo $prescription["title"]; ?></th>
				<td><?php echo $prescription["details"]; ?></th>		
				
				
			</tr>
<?php
		}
?>
		</table>

<?php
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
