<?php 

Class Signup extends Controller
{

	public function index()
	{

		$data['page_title'] = "Signup";

		if($_SERVER['REQUEST_METHOD'] == "POST") // kiểm tra method
		{
 			
			$user = $this->load_model("User");// chạy model
			$user->signup($_POST);
		}

		$this->view("signup",$data);// trỏ tới view
	}


}