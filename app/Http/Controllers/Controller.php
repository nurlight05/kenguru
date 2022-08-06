<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

define("SMSC_LOGIN", "kenguru-dostavka"); // логин клиента
define("SMSC_PASSWORD", "admin123!");	  // пароль
define("SMSC_POST", 0);					  // использовать метод POST
define("SMSC_HTTPS", 0);				  // использовать HTTPS протокол
define("SMSC_CHARSET", "windows-1251");	  // кодировка сообщения: utf-8, koi8-r или windows-1251 (по умолчанию)
define("SMSC_DEBUG", 0);				  // флаг отладки
define("SMTP_FROM", "api@smsc.kz");       // e-mail адрес отправителя

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('home.main.index');
    }

    public function feedback(Request $request)
    {
        $name = $request->name; //имя клиента из html формы (атрибут name="name")
        $phone = $request->phone;
        $point_a = $request->point_a;
        $point_b = $request->point_b;
        $text = $request->text;
        $message = "Заказ от:" . $name . "<br>" . "\n Номер телефона:" . $phone . "<br>" . "\n От куда:" . $point_a . "<br>" . "\n Куда:" . $point_b . "<br>" . "\n Комментарий:" . $text;
        $to = 'kengurusd@gmail.com'; //почта на которую падают заявки kengurusd@gmail.com
        $subject = 'Новый заказ:'; //название письма

        $headers = "From: no-reply@kenguru-dostavka.kz\r\n"; //заменить домен
        $headers .= "Reply-To: no-reply@kenguru-dostavka.kz\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        $send = mail($to, ' Заказ с сайта kenguru-dostavka.kz', $message, $headers);
        if ($send) {
            return redirect()->route('main', ['#success']);
        } else {
            return redirect()->route('main');
        }
    }
}
