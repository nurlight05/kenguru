<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));

	$phone = $data['phone'];
	$password = $data['password'];
	$phone_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone'") or die("NOT FOUND!");
	$phone_c = @mysqli_fetch_assoc($phone_query);
	if($phone_c){
		$token = base64_encode($phone . ':' . $password);
	$user_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone' AND password='$password'") or die("NOT FOUND!");
	$user = @mysqli_fetch_assoc($user_query);


	  if($user){	
		      $user = array(
			   'id'=>$user['id'],
			   'full_name'=>$user['full_name'],
			   'email'=>$user['email'],
			   'birthday'=>$user['birthday'],
			   'phone'=>$user['phone'],
			   'deleted_at'=>'null',
			   'created_at'=>'2020-10-24T13:10:15.000000Z',
			   'updated_at'=>'2020-10-24T13:10:15.000000Z'
			   );
			   $result = array(
				   'token'=>$token,
				   'user'=>$user
			   );
				   
				
			  header('Content-Type: application/json');
			  echo json_encode($result);
		  
	  }else{
		//if user doesnt exist
		$result =[
				'error'=>'5',
				'description'=>'Invalid password'
				];
		header('Content-Type: application/json');
		echo json_encode($result);  
		  
	  }
	
	}else{
		$result =[
				'error'=>'4',
				'description'=>'User not found.'
				];
		header('Content-Type: application/json');
		echo json_encode($result);  
	
	
	}
	

	
