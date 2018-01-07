<?php
include_once "model/globals.php";
include_once "model/database.php";

class Prescription 
{
	protected $database;
	protected $title;
	protected $description;
	
	public function __construct()  
    {  
		global $db_server, $db_username, $db_password, $db_name;
		$this->database = new Database($db_server, $db_username, $db_password, $db_name);
		$this->database->connect();
    } 

	public function set($title, $description)  
    {  
        $this->title = $title;
	    $this->description = $description;
    } 

    public function add(&$errors)
    {

		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["title"])) $errors["title"]="Empty";
			if(empty($_REQUEST["description"])) $errors["description"]="Empty";
			if(empty($errors))
			{
				$this->set($_REQUEST["title"], $_REQUEST["description"]); 
				$time = time();
				$sql="insert into prescription (date,patient_id,title,details) values ('$time',{$_SESSION['uid']},'{$this->title}', 
				       '{$this->description}')";
				$this->database->execute($sql); 
				$status="success";
			}
			else $status="failure";
		}
		return $status;
	}

    public function p_list()
    {
		//$sql="select * from prescription order by title where where id='{$_SESSION['uid']}'";
		$sql="select * from prescription where patient_id={$_SESSION['uid']} order by date";
		$prescriptions=$this->database->execute($sql);
		return $prescriptions;
	}

	public function search($name) {
		$sql="select * from prescription p INNER JOIN user as u ON u.id = p.patient_id 
		         where p.name like '%{$name}%' OR p.username like '%{$name}%' order by date";
		$prescriptions=$this->database->execute($sql);
		return $prescriptions;
	}


}
?>
