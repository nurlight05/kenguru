<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));

	$fromStreet = $data['from_street'];
	$fromBuilding = $data['from_building'];
	$fromRoomNumber = $data['from_room_number'];
	$fromFloor = $data['from_floor'];
	$fromIntercom = $data['from_intercom'];
	$fromLong = $data['from_long'];
	$fromLat = $data['from_lat'];
	$toStreet = $data['to_street'];
	$toBuilding = $data['to_building'];
	$toRoomNumber = $data['to_room_number'];
	$toFloor = $data['to_floor'];
	$toIntercom = $data['to_intercom'];
	$toLong = $data['to_long'];
	$toLat = $data['to_lat'];
	$vehicleType = $data['vehicle_type'];
	
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
				$connection->query("INSERT INTO orders (from_street, from_building, from_room_number, from_floor, from_intercom, from_long, from_lat, to_street, to_building, to_room_number, to_floor, to_intercom, to_long, to_lat, vehicle_type) VALUES ('$fromStreet', $fromBuilding, $fromRoomNumber, $fromFloor, $fromIntercom, $fromLong, $fromLat, '$toStreet', $toBuilding, $toRoomNumber, $toFloor, $toIntercom, $toLong, $toLat, '$vehicleType')");
				
				$last_id = $connection->insert_id;
				
				$user_id = $user['id'];
				$connection->query("INSERT INTO order_user (user_id, order_id) VALUES ($user_id, $last_id)");
				
				$order_query = @mysqli_query($connection,"SELECT * FROM orders WHERE id=$last_id") or die("NOT FOUND!");
				$order = @mysqli_fetch_assoc($order_query);
				
				$result = array(
					'order'=>$order
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
	

	
