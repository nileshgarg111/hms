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
				<th>Request From</th>
				<th>Action</th>
			</tr>
<?php
		foreach($requests as $request)
		{
?>
			<tr>
				<td><?php echo $request["title"]; ?></th>
				<td><?php echo $request["full_name"]; ?></td>
				<td><a href="index.php?page=request_approve&caller=self&id=<?php echo $request["req_id"]; ?>">Approve</a></th>
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
