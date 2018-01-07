<?php
	global $user_type;

	if(!empty($before_login))
	{
?>
<ol>
	<li><a href="index.php?page=index">Home</a></li>
	<li><a href="index.php?page=register">Register</a></li>
	<li><a href="index.php?page=login">Login</a></li>
	<li><a href="index.php?page=forgot_password">Forgot Password</a></li>
</ol>
<?php
	}
	else if($after_login)
	{
?>
<ol>
    
    <li><a href="index.php?page=home">Home</a></li>
	<li><a href="index.php?page=profile">Profile</a></li>
	
    <?php if($_SESSION['user_type'] == $user_type['patient']){ ?>

    <li><a href="index.php?page=prescription_add">Add Prescription</a></li>
	<li><a href="index.php?page=prescription_list">List Prescription</a></li>
	<li><a href="index.php?page=request_approve">Approve Request</a></li>
	
    <?php } ?>

    <?php if($_SESSION['user_type'] == $user_type['pharmacist'] || $_SESSION['user_type'] == $user_type['doctor']){ ?>
    <li><a href="index.php?page=request_add">Send Request</a></li>
	<li><a href="index.php?page=request_list">Request List</a></li>
    <?php }?>

	<li><a href="index.php?page=logout">Logout</a></li>
</ol>
<?php
	}
?>
