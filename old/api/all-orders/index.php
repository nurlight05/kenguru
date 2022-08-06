<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));
	
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
				$user_id = $user['id'];
				$orders_query = @mysqli_query($connection,"SELECT * FROM orders WHERE id IN (SELECT order_id FROM order_user WHERE user_id=$user_id)") or die("NOT FOUND!");
				$orders = @mysqli_fetch_all($orders_query, MYSQLI_ASSOC);
				
				$result = array(
					'orders'=>$orders
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
	

	
