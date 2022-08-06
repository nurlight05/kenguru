<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));
	$full_name = $data['full_name'];
	$email = $data['email'];
	$birthday = $data['birthday'];
	$phone = $data['phone'];
	$password = $data['password'];
	$code = rand(1,10000);
	$user_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone'") or die("NOT FOUND!");
	$user = @mysqli_fetch_assoc($user_query);
		
	  if($user){
		  //if user exist
		  $result =[
				'error'=>'1',
				'description'=>'This phone number is already registered in the system.'
				];
		  
		  header('Content-Type: application/json');
		  echo json_encode($result);
		  
	  }else{
		//if user doesnt exist
			 if($connection->query("INSERT INTO users (full_name,email,birthday,phone,password) 	 VALUES('$full_name','$email','$birthday','$phone','$password')")){
				
				$connection->query("INSERT INTO sms (sms_code) VALUES('$code')");
				$sms_query = @mysqli_query($connection,"SELECT * FROM sms ORDER BY id DESC LIMIT 1") or die("NOT FOUND!");
				$sms = @mysqli_fetch_assoc($sms_query);
				$result =[
					'phone'=>$phone,
					'sms_id'=>$sms['id']
				];
				
				header('Content-Type: application/json');
				echo json_encode($result);


			}else{
				$result =[
				'error'=>'0',
				'description'=>'Database error.'
				];
				
		  		header('Content-Type: application/json');
		  		echo json_encode($result);
			}
		  
	  }
	
	
	

	
