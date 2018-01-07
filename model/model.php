<?php
include_once("model/prescription.php");
include_once("model/user.php");
include_once("model/request.php");

class Model 
{
	protected $user;
	protected $prescription;
	protected $request;
	
	
	public function __construct()  
    {  
		$this->user = new User();
		$this->prescription = new Prescription();
		$this->request = new Request();
    } 
	
	public function register(&$errors)
	{
		return $this->user->register($errors);
	}
	
	public function login(&$errors)
	{
		return $this->user->login($errors);
	}
	
	public function forgot_password(&$errors)
	{
		return $this->user->forgot_password($errors);
	}
	
	public function logged_in()
	{
		return $this->user->logged_in();
	}

	public function logout()
	{
		return $this->user->logout();
	}
	
	public function profile(&$errors, &$profile)
	{
		return $this->user->profile($errors, $profile);
	}

	public function prescription_add(&$errors)
	{
		return $this->prescription->add($errors);
	}

	public function prescription_list()
	{
		return $this->prescription->p_list();
	}

	public function prescription_search($name)
	{
		return $this->prescription->search($name);
	}
	
	public function request_add(&$errors)
	{
		return $this->request->add($errors);
	} 

	public function request_list()
	{
		return $this->request->r_list();
	}
	public function request_approve(&$errors, &$requests)
	{
		return $this->request->approve($errors, $requests);
	}

}

?>
