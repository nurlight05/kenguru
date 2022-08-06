<?php 
if(isset($_POST['getfeedback'])){
	$name = $_POST['name']; //имя клиента из html формы (атрибут name="name")
  	$phone = $_POST['phone']; 
	$point_a = $_POST['point_a'];
	$point_b = $_POST['point_b'];
	$text = $_POST['text'];
    $message ="Заказ от:". $name ."<br>"."\n Номер телефона:" .$phone ."<br>"."\n От куда:" .$point_a."<br>"."\n Куда:" .$point_b ."<br>"."\n Комментарий:" .$text;
      $to = 'kengurusd@gmail.com'; //почта на которую падают заявки kengurusd@gmail.com
      $subject = 'Новый заказ:'; //название письма
           
        $headers = "From: no-reply@kenguru-dostavka.kz\r\n"; //заменить домен
        $headers .= "Reply-To: no-reply@kenguru-dostavka.kz\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        $send = mail($to,' Заказ с сайта kenguru-dostavka.kz', $message, $headers);
			if($send){
			  header('Location:/#success'); //перенаправление на модальное окно "успешная отправка заявки"
			}else{
			  header('Location:/'); 
			}
}
?>