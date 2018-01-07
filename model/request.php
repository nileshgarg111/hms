<?php
include_once "model/globals.php";
include_once "model/database.php";

class Request 
{
	protected $database;
	
	public function __construct()  
    {  
		global $db_server, $db_username, $db_password, $db_name;
		$this->database = new Database($db_server, $db_username, $db_password, $db_name);
		$this->database->connect();
    } 


    public function add(&$errors)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
			if(empty($_REQUEST["pres_id"])) $errors["pres_id"]="Empty";
			if(empty($errors))
			{
				$time = time();
				$sql="insert into request (date,pres_id,req_from,status) values 
				                          ('$time','{$_REQUEST["pres_id"]}',{$_REQUEST["id"]},'{$_REQUEST["status"]}')";
				$this->database->execute($sql); 
				$status="success";
			}
			else $status="failure";
		}
		return $status;
	}

    public function r_list()
    {
		$sql="select *,r.status as req_status from request as r 
		         INNER JOIN prescription as p ON r.pres_id = p.pres_id
		         INNER JOIN user as u ON u.id = p.patient_id
		         where req_from = {$_SESSION['uid']} order by r.date";
		$requests=$this->database->execute($sql);
		return $requests;
	}

	public function approve(&$errors, &$requests)
    {
		if(empty($_REQUEST["caller"])) $status="before_submission";
		else if($_REQUEST["caller"]=="self")
		{
			$errors=array();
				$sql="update request set status='APPROVED' where req_id='{$_REQUEST["id"]}'";
				$this->database->execute($sql); 
				$status="success";
	    }

		$sql="select *,r.status as req_status from request as r 
		         INNER JOIN prescription as p ON r.pres_id = p.pres_id
		         INNER JOIN user as u ON u.id = r.req_from
		         where patient_id = {$_SESSION['uid']} AND r.status = 'PENDING' order by r.date";

		$requests=$this->database->execute($sql);
		
		return $status;
	}



}
?>
