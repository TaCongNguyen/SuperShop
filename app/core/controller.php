<?php 

Class Controller
{

	public function view($path,$data = []) // hiển thị view
	{

		if(is_array($data)){
 			extract($data);
		}

		if(file_exists("../app/views/" . THEME . $path . ".php"))
		{
			include "../app/views/" . THEME . $path . ".php";
		}else{
			include "../app/views/" . THEME . "404.php";// ko tìm thấy trang thì chuyển sang 404
		}
	}

	public function load_model($model)// truy xuất đến model
	{

		if(file_exists("../app/models/" . strtolower($model) . ".class.php"))
		{
			include_once "../app/models/" . strtolower($model) . ".class.php";
			return $a = new $model();
		}

		return false;
	}


}