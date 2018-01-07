<?php 
	include_once "header.php";
	if($logged_in)
	{
		$after_login=true;
		include_once "menu.php";
?>

		<table border="1" width="50%" align="center">
			<tr>
				<th>User</th> 
				<th>Title</th>
				<th>Details</th>
				<th>Status</th>
			</tr>
<?php
		foreach($requests as $request)
		{
?>
			<tr>
				<td><?php echo $request["full_name"]; ?></td>
				<td><?php echo $request["title"]; ?></th>
				<?php if($request["req_status"] == 'APPROVED') { ?>
					<td><?php echo $request["details"]; ?></th>
				<?php } else { ?>
					<td>NA</th>
			    <?php } ?>	
				
				<td><?php echo $request["req_status"]; ?></th>
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
