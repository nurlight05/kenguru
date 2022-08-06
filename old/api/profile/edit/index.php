<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));

	$email = $data['email'];
	$password = $data['password'];
	$fullName = $data['full_name'];
	$birthday = $data['birthday'];
	
	if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
		$result = array(
			'error' => '6',
			'description' => 'Authentication is missing!'
		);
		header('Content-Type: application/json');
		echo json_encode($result);
	} else {
		$auth = $_SERVER["HTTP_AUTHORIZATION"];
		$auth_array = explode(" ", $auth);
		$un_pw = explode(":", base64_decode($auth_array[1]));
		$phone = $un_pw[0];
		$password = $un_pw[1];
		
		$phone_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone'") or die("NOT FOUND!");
		$phone_c = @mysqli_fetch_assoc($phone_query);
		
		if ($phone_c) {
			
			$user_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone' AND password='$password'") or die("NOT FOUND!");
			$user = @mysqli_fetch_assoc($user_query);
			
			if ($user) {
				$connection->query("UPDATE users SET email='$email', password='$password', full_name='$fullName', birthday='$birthday' WHERE phone='$phone'");
				
				$user_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone'") or die("NOT FOUND!");
				$user = @mysqli_fetch_assoc($user_query);
				
				$result = array(
					'user'=>$user
				);
				
				header('Content-Type: application/json');
				echo json_encode($result);
			} else {
				$result = array(
					'error'=>'5',
					'description'=>'Invalid password.'
				);
				header('Content-Type: application/json');
				echo json_encode($result);  
			}
			
		} else {
			$result = array(
				'error'=>'4',
				'description'=>'User not found.'
			);
			header('Content-Type: application/json');
			echo json_encode($result); 
		}
	}
	

	
