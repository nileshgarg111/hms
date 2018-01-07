<?php
include_once("model/model.php");

class Controller 
{
	protected $model;
	
	public function __construct()  
    {  
        $this->model = new Model();
    } 
	
	public function index()
	{
		include_once "view/index.php";
	}
	
	public function register()
	{
		$status=$this->model->register($errors);
		include_once "view/register.php";
	}

	public function login()
	{
		$status=$this->model->login($errors);
		include_once "view/login.php";
	}
	
	public function forgot_password()
	{
		$status=$this->model->forgot_password($errors);
		include_once "view/forgot_password.php";
	}

	public function home()
	{
		$logged_in=$this->model->logged_in();
		include_once "view/home.php";
	}

	public function logout()
	{
		$logged_in=$this->model->logout();
	}

	public function profile()
	{
		$logged_in=$this->model->logged_in();
		$status=$this->model->profile($errors, $profile);
		include_once "view/profile.php";
	}


    public function prescription_add(){
    	$logged_in=$this->model->logged_in();
		$status=$this->model->prescription_add($errors);
		include_once "view/prescription_add.php";
    }

    public function prescription_list()
	{
		$logged_in=$this->model->logged_in();
		$prescriptions=$this->model->prescription_list();
		include_once "view/prescription_list.php";
	}

	public function prescription_search()
	{
		$logged_in=$this->model->logged_in();
		$prescriptions=$this->model->prescription_search();
		include_once "view/prescription_list.php";
	}


	public function request_add(){
		$logged_in=$this->model->logged_in();
		$status=$this->model->request_add($errors);
		include_once "view/request_add.php";	
	}

	public function request_list(){
		$logged_in=$this->model->logged_in();
		$requests=$this->model->request_list();
		include_once "view/request_list.php";	
	}

	public function request_approve()
	{
		$logged_in=$this->model->logged_in();
		$status=$this->model->request_approve($errors, $requests);
		include_once "view/request_approve.php";
	}

}

?>
