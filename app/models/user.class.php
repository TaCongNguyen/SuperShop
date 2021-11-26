<?php 

Class User 
{
	private $error = "";

	public function signup($POST)// hàm đăng kí
	{
		$data = array();
		$db = Database::getInstance();

		$data['name'] 		= trim($POST['name']);
		$data['email'] 		= trim($POST['email']);
		$data['password'] 	= trim($POST['password']);
		$password2 			= trim($POST['password2']);
		// check các thuộc tính
		if(empty($data['email']) || !preg_match("/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/", $data['email']))
		{
			$this->error .= "Nhập email hợp lệ <br>";
		}

		if(empty($data['name']) || !preg_match("/^[a-zA-Z]+$/", $data['name']))
		{
			$this->error .= "Nhập Tên đăng nhập hợp lệ ( chỉ chứ chữ, ko chứa số và khoảng trắng <br>";
		}

		if($data['password'] !== $password2)
		{
			$this->error .= "Mật khẩu không khớp <br>";
		}

		if(strlen($data['password']) < 4)
		{
			$this->error .= "Mật khẩu phải có ít nhất 4 kí tự <br>";
		}

		//kiểm tra  email đã tồn tại
		$sql = "select * from users where email = :email limit 1";
		$arr['email'] = $data['email'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){
			$this->error .= "Email đã bị dùng <br>";
		}

		$data['url_address'] = $this->get_random_string_max(60);

		//kiểm tra url_address
		$arr = false;
		$sql = "select * from users where url_address = :url_address limit 1";
		$arr['url_address'] = $data['url_address'];
		$check = $db->read($sql,$arr);
		if(is_array($check)){

			$data['url_address'] = $this->get_random_string_max(60);
		}

		if($this->error == ""){// lưu ng dùng vào database nếu ko lỗi
			
			$data['rank'] = "customer";
			$data['date'] = date("Y-m-d H:i:s");
			$data['password'] = hash('sha1',$data['password']);// mã hoá mật khẩu để bảo mật

			$query = "insert into users (url_address,name,email,password,rank,date) values (:url_address,:name,:email,:password,:rank,:date)";
			$result = $db->write($query,$data);

			if($result){

				header("Location: " . ROOT . "login");
				die;
			}

		}

		$_SESSION['error'] = $this->error;

	}

	public function login($POST)// hàm đăng nhập
	{

		$data = array();
		$db = Database::getInstance();

 		$data['email'] 		= trim($POST['email']);
		$data['password'] 	= trim($POST['password']);
 
		if(empty($data['email']) || !preg_match("/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/", $data['email']))
		{
			$this->error .= "Nhập email hợp lệ <br>";
		}
 
 		if(strlen($data['password']) < 4)
		{
			$this->error .= "Mật khẩu phải dài 4 kí tự trở lên <br>";
		}

  		if($this->error == ""){

			// Xác nhận
 			$data['password'] = hash('sha1',$data['password']);

			//Kiểm tra email có tồn tại
			$sql = "select * from users where email = :email && password = :password limit 1";
 			$result = $db->read($sql,$data);
			if(is_array($result)){
				
				$_SESSION['user_url'] = $result[0]->url_address;
				
				if(isset($_SESSION['intended_url'])){
					
					$url = $_SESSION['intended_url'];
					unset($_SESSION['intended_url']);
					header("Location: " . $url);
				}else{
					header("Location: " . ROOT . "home");
				}
				
				die;
			}

			$this->error .= "Sai toàn khoản hoặc mật khẩu <br>";

		}

		$_SESSION['error'] = $this->error;
	}

	public function get_user($url)
	{

		$db = Database::newInstance();
		$arr = false;

		$arr['url'] = addslashes($url);
		$query = "select * from users where url_address = :url limit 1";

		$result = $db->read($query,$arr);
		
		if(is_array($result))
		{
			return $result[0];
		}

		return false;
	}

	public function get_customers()
	{

		$db = Database::newInstance();
		$arr = false;

		$arr['rank'] = "customer";
		$query = "select * from users where rank = :rank ";

		$result = $db->read($query,$arr);
		
		if(is_array($result))
		{
			return $result;
		}

		return false;
	}
	
	public function get_admins()
	{

		$db = Database::newInstance();
		$arr = false;

		$arr['rank'] = "admin";
		$query = "select * from users where rank = :rank ";

		$result = $db->read($query,$arr);
		
		if(is_array($result))
		{
			return $result;
		}

		return false;
	}


	private function get_random_string_max($length) {

		$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";

		$length = rand(4,$length);

		for($i=0;$i<$length;$i++) {

			$random = rand(0,61);
			
			$text .= $array[$random];

		}

		return $text;
	}
	// kiểm tra đăng nhập
	public function check_login($redirect = false, $allowed = array())
	{

		$db = Database::getInstance();

		if(count($allowed) > 0){
		
			$arr['url'] = isset($_SESSION['user_url']) ? $_SESSION['user_url'] : '' ;
			$query = "select * from users where url_address = :url limit 1";
			$result = $db->read($query,$arr);
				
			if(is_array($result))
			{
				$result = $result[0];
				if(in_array($result->rank, $allowed)){

					return $result;
				}

			}
			
			$_SESSION['intended_url'] = FULL_URL; 
			header("Location: " . ROOT . "login");
			die;
 
		}else{
			 
	 		if(isset($_SESSION['user_url']))
			{
				$arr = false;
				$arr['url'] = $_SESSION['user_url'];
				$query = "select * from users where url_address = :url limit 1";

				$result = $db->read($query,$arr);
				
				if(is_array($result))
				{
					return $result[0];
				}
			}

			if($redirect){
				$_SESSION['intended_url'] = FULL_URL; 
				header("Location: " . ROOT . "login");
				die;
			}
		}

		return false;

	}

	public function logout()// hàm đăng xuất
	{

		if(isset($_SESSION['user_url']))
		{
			unset($_SESSION['user_url']);
		}

		header("Location: " . ROOT . "home");
		die;
	}


}