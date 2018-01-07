<?php
include_once "model/globals.php";
include_once "model/database.php";

class User 
{
	protected $database;
	protected $name;
	protected $username;
	protected $password;
	protected $logged_in;
	protected $user_type;
	
	public function __construct()  
    {  
		global $db_server, $db_username, $db_password, $db_name;
		$this->database = new Database($db_server, $db_username, $db_password, $db_name);
		$this->database->connect();
    } 
	
	public function set($name, $username, $password,$user_type = 1)  
    {  
        $this->name = $name;
	    $this->username = $username;
	    $this->password = $password;
	    $this->user_type = $user_type;
    } 

    public function register(&$errors)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["name"])) $errors["name"]="Empty";
			if(empty($_REQUEST["username"])) $errors["username"]="Empty";
			if(empty($_REQUEST["user_type"])) $errors["user_type"]="Empty";
			else
			{
				$sql="select count(*) as total from user where username='{$_REQUEST["username"]}'";
				$result=$this->database->execute($sql);
				$total=$result[0]["total"];
				if($total) $errors["username"]="Duplicate";
			}
			if(empty($_REQUEST["password"])) $errors["password"]="Empty";
			if(empty($errors))
			{
				$this->set($_REQUEST["name"], $_REQUEST["username"], $_REQUEST["password"],$_REQUEST["user_type"]); 
				$sql="insert into user values (null, '{$this->username}', password('{$this->password}'), '{$this->name}',{$this->user_type})";
				$this->database->execute($sql); 
				$status="success";
				
			}
			else $status="failure";
		}
		return $status;
	}

    public function login(&$errors)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["username"])) $errors["username"]="Empty";
			else
			{
				$sql="select * from user where username='{$_REQUEST["username"]}'";
				$result=$this->database->execute($sql);
				$total=count($result);
				if($total==0) $errors["username"]="Invalid";
			}
			if(empty($_REQUEST["password"])) $errors["password"]="Empty";
			if(empty($errors))
			{	$status="success";
			}
			else $status="failure";
		}
		return $status;
	}

    public function forgot_password(&$errors)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["username"])) $errors["username"]="Empty";
			else
			{
				$sql="select * from user where username = '{$_REQUEST["username"]}'";
				$result=$this->database->execute($sql);
				$total=$result[0]["username"];
				if($total==0) $errors["username"]="Invalid";
			}
			if(empty($errors))
			{
				//Send new password to the user email address.
				$status="success";
			}
			else $status="failure";
		}
		return $status;
	}
	
	public function logged_in()
	{
		session_start();
		
		$username = $_SESSION['username'];
		if(empty($username)) $username = $_REQUEST['username'];

		$password = $_SESSION['password'];
		if(empty($password)) $password = $_REQUEST['password'];

		$sql="select * from user where username='$username' and password=PASSWORD('$password')"; 
		$result=$this->database->execute($sql);
		if($result)
		{
			$this->logged_in=true;
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$_SESSION['user_type']=$result[0]['user_type'];
			$_SESSION['uid']=$result[0]['id'];		

		}
		else
		{
			$this->logged_in=false;
			session_destroy();
		}
		return $this->logged_in;
	}
	
	public function logout()
	{
		session_start();
		session_destroy();
		$this->logged_in=false;
		header("location:index.php");
	}
	
    public function profile(&$errors, &$profile)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["name"])) $errors["name"]="Empty";
			if(empty($errors))
			{
				if(empty($_REQUEST["password"]))
				$sql="update user set name='{$_REQUEST["name"]}' where username='{$_REQUEST["username"]}'";
				else
				{
					$sql="update user set name='{$_REQUEST["name"]}', password=password('{$_REQUEST["password"]}') where username='{$_REQUEST["username"]}'";
					$_SESSION["password"]=$_REQUEST["password"];
				}
				
				$this->database->execute($sql); 
				
				$status="success";
				
			}
			else $status="failure";
		}
		$sql="select * from user where username='{$_SESSION["username"]}'";
		$profile=$this->database->execute($sql);
		return $status;
	}

}
?>
