<?php

	$data = json_decode(file_get_contents("php://input"),true);
	$host = 'srv-db-plesk01.ps.kz:3306'; // адрес сервера 
 	$database = 'kengurud_base_temp'; // имя базы данных
 	$user = 'kengurud_ayan'; // имя пользователя
 	$password = 'Ayan15757!'; // пароль
 	$connection = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($connection));
	$phone = $data['phone'];
	$sms_id = $data['sms_id'];
	$sms_code = $data['sms_code'];
	
	$sms_query = @mysqli_query($connection,"SELECT * FROM sms WHERE id='$sms_id' LIMIT 1") or die("NOT FOUND!");
	$sms = @mysqli_fetch_assoc($sms_query);
		
	  if($sms){
		if($sms['sms_code'] == $sms_code){
		   $user_query = @mysqli_query($connection,"SELECT * FROM users WHERE phone='$phone' LIMIT 1") or die("NOT FOUND!");
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
			   $result = array('token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9WMVwvbG9naW4iLCJpYXQiOjE2MDM1NDUxNjMsIm5iZiI6MTYwMzU0NTE2MywianRpIjoiV21vUTFKaUFGTFQzZVI4OSIsInN1YiI6MywicHJ2IjoiMGE2NTQ0ZGRlYTY1YzczYzFkZGVkMGNiYTA5ZmExODZjMWFlY2FlNiJ9.98-4w31I07xvTjV6289te-T7CTYEhiwA1Mall4-Julk',
				   'user'=>$user
			   );
				   
				
			  header('Content-Type: application/json');
			  echo json_encode($result);
			   
		   }else{
			   
			   $result =[
				'error'=>'4',
				'description'=>'User not found'
				];
			  
			  header('Content-Type: application/json');
			  echo json_encode($result);
		   	
		   }
		
		}else{
			
		$result =[
				'error'=>'3',
				'description'=>'Sms code is not valid'
				];
		  
		  header('Content-Type: application/json');
		  echo json_encode($result);
		
		}


		}else{

		 $result =array(
				'error'=>'2',
				'description'=>'Sms code not found'
				);
		  
		  header('Content-Type: application/json');
		  echo json_encode($result);

		}
