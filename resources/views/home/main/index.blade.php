<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenguru - самая быстрая курьерская служба в Алматы и Алматинской области</title>
    <link rel="shortcut icon" href="{{ asset('assets/home/img/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/home/styles/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/styles/responsive.css') }}">
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(68580439, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/68580439" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="nav-fixed" id="fixed-bg">
                <nav class="navbar_new container">
                    <div class="logo">
                        <img src="{{ asset('assets/home/img/logo.svg') }}" alt="Logo Image">
                    </div>
                    <div class="hamburger">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="line3"></div>
                    </div>
                    <ul class="nav-links">
                        <li>
                            <a class="hover-1 close-nav" href="#main">Главная</a>
                        </li>
                        <li>
                            <a class="hover-1 close-nav" href="#about">О нас</a>
                        </li>
                        <li>
                            <a class="hover-1 close-nav" href="#dostavka">Виды посылок</a>
                        </li>
                        <li>
                            <a class="hover-1 close-nav" href="#process">Как мы работаем?</a>
                        </li>
                        <li>
                            <a class="hover-1 close-nav" href="#preim">Преимущества</a>
                        </li>
                        <li>
                            <a class="hover-1 close-nav" href="#contact">Контакты</a>
                        </li>
                    </ul>
                    <div class="nav-btns">
                        <a href="tel:+77005777001">+7 (700) 577 70 01</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>
<section class="first white" id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-8 col-8 align-self-center">
                <div class="banner-text">
                    <p>Курьерская служба в Алматы и Алматинской области</p>
                    <h1>Доставим ваши  <span class='typewriter-text' data-text='[ "документы", "цветы", "ключи", "мелкие грузы", "посылки", "продукты", "еду", "инструменты" ]'></span> в считанные минуты</h1>
                </div>
                <div class="d-flex icons">
                    <div>
                        <img class="mb-3" src="{{ asset('assets/home/img/icons/icon-1.svg') }}" alt="">
                        <p>
                            Оперативная доставка
                        </p>
                    </div>
                    <div>
                        <img class="mb-3" src="{{ asset('assets/home/img/icons/icon-2.svg') }}" alt="">
                        <p>
                            Собственный мотопарк
                        </p>
                    </div>
                    <div>
                        <img class="mb-3" src="{{ asset('assets/home/img/icons/icon-3.svg') }}" alt="">
                        <p>
                            Бережная доставка
                        </p>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 text-right mt-5">
                <img src="img/img-banner.svg" alt="">
            </div> -->
        </div>
    </div>
</section>
<section class="second ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <h2>Хочу<span class="main-color"> доставку </span> </h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 bag">
                <img src="{{ asset('assets/home/img/img-five.svg') }}" alt="">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 align-self-center text-right">
                <form action="{{ route('feedback') }}" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="имя" required>
                    <input type="text" name="point_a" placeholder="от куда?" required>
                    <input type="text" name="point_b" placeholder="куда?" required>
                    <input type="text" name="phone" placeholder="номер телефона" required>
                    <input type="text" name="text" placeholder="что нужно доставить?" required>
                    <button name="getfeedback" class="btn-1 text-white">Заказать </button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="third" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <h2 class="mb-5" >Немного  <span class="main-color"> о компаний </span> </h2>
                <div>
                    <p>Курьерская компания «Kenguru»  специализируется на доставке посылок в городе Алматы и Алматинской области. Наша команда курьеров осуществляет оперативную передачу мелких грузов, цветов, ключей, документов и многое другое за короткое время. Мы доверяем доставку ваших вещей только доверенным лицам, нашим курьерам. Также гарантируя конфиденциальность, мы опечатываем ваш груз, специальной именной записью компании.
                    </p>
                    <p>Наша цель - доставить вашу посылку доступно и в сроки.
                        Наш собственный мото парк, со своими курьерами полностью могут удовлетворить вышеуказанную цель.
                    </p>
                    <p>С/у: команда Kenguru.

                    </p>
                    <p>Для тех, кто ценит время</p>
                </div>

            </div>
            <div class="col-lg-5  col-md-5 text-right">
                <img src="{{ asset('assets/home/img/img-second.svg') }}" alt="">
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="d-flex icons">
                    <div>
                        <img class="desktop" src="{{ asset('assets/home/img/03.png') }}" alt="">
                        <img class="mobile" src="{{ asset('assets/home/img/03w.png') }}" alt="">
                        <p>
                            лет на рынке
                        </p>
                    </div>
                    <div>
                        <img class="desktop" src="{{ asset('assets/home/img/500.png') }}" alt="">
                        <img class="mobile" src="{{ asset('assets/home/img/500+w.png') }}" alt="">
                        <p>
                            довольных клиентов
                        </p>
                    </div>
                    <div>
                        <img class="desktop" src="{{ asset('assets/home/img/236k.png') }}" alt="">
                        <img class="mobile" src="{{ asset('assets/home/img/236k+w.png') }}" alt="">
                        <p>
                            км пройдено
                        </p>
                    </div>
                    <div>
                        <img class="desktop" src="{{ asset('assets/home/img/198.png') }}" alt="">
                        <img class="mobile" src="{{ asset('assets/home/img/+198w.png') }}" alt="">
                        <p>
                            вещей доставлено
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="four" id="dostavka">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Что мы<span class="main-color"> доставляем? </span></h2>
            </div>
            <div class="col-lg-5 col-md-5 text-center">
                <img src="{{ asset('assets/home/img/moto.png') }}" alt="">
            </div>
            <div class="col-lg-7 col-md-7 mt-5">
                <p>Наш сервис по доставке “Kenguru” специализируется на доставке различного рода мелких вещей. С помощью нашего сервиса вы можете осуществить доставку по городу Алматы и Алматинской области за короткое время.
                    <br>Часть доставляемых нами вещей:</p>
                <div class="wrapp">
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-4.svg') }}" alt="">
                        <span>
								Документ
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-5.svg') }}" alt="">
                        <span>
								Цветы
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-6.svg') }}" alt="">
                        <span>
								Ключи
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-7.svg') }}" alt="">
                        <span>
								Мелкий груз
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-8.svg') }}" alt="">
                        <span>
								Посылки
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-9.svg') }}" alt="">
                        <span>
								Продукты
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-10.svg') }}" alt="">
                        <span>
								Еда
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-11.svg') }}" alt="">
                        <span>
								Инструменты
							</span>
                    </div>
                    <div>
                        <img src="{{ asset('assets/home/img/icons/icon-12.svg') }}" alt="">
                        <span>
								И другие
							</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="five">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="white mt-5">Доставим ваши документы в считанные минуты</h2>
                <img src="{{ asset('assets/home/img/motogif.gif') }}" alt="">
                <button type="button" class="btn-1"  data-toggle="modal" data-target="#modal_window">Оставить заявку</button>
                <!-- <button type="button" class="btn-first" data-toggle="modal" data-target="#exampleModal">Оставить заявку</button> -->
            </div>
        </div>
    </div>
</section>
<section class="six" id="process">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <h2>Как мы<span class="main-color"> работаем? </span> </h2>
            </div>
        </div>
        <div class="six-block">
            <div class="row justify-content-start">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <span class="one">1</span>
                    <h2>Вы вызоваете курьера</h2>
                    <p class="ml-auto text1">Оставьте заявку и наш менеджер обязательно c вами свяжется</p>
                </div>
            </div>
            <div class="row justify-content-end white my-5">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <span class="two">2</span>
                    <h2 class="ml-auto mr-3">Получаете бесплатную консультацию</h2>
                    <p class="text2">Менеджер сообщает стоимость и время доставки, согласует некоторые моменты и отправляет груз на доставку</p>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <span class="three">3</span>
                    <h2>Доставка завершена</h2>
                    <p class="ml-auto text3">Процесс доставки завершена. Вы получаете свой груз прямо в руки и оплачиваете.</p>
                </div>
            </div>
        </div>
</section>
<section class="seven" id="preim">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <h2>Почему <span class="main-color"> выбирают </span> нас?</h2>
            </div>
            <div class="col-lg-12">
                <div class="why-wrapp">
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-1.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Собственный мото-парк
								</span>
                            <p>
                                На нашем мотопарке более 40 мопедов.
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-2.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Конфиденциальность
								</span>
                            <p>
                                Мы специально перед отправкой груза опечатываем его специальной технологией.
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-3.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Экономия времени
								</span>
                            <p>
                                С помощью нашей курьерской службы доставки вы позаботитесь о своих делах, зная, что наши курьеры доставят вашу посылку вовремя.
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-4.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Штатные курьеры
								</span>
                            <p>
                                Мы доверяем доставку вашего мелкого груза, только специально отобранным курьерам.
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-5.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Надежность
								</span>
                            <p>
                                Мы гарантируем, что даже самые хрупкие посылки будут доставлены в целости и сохранности.
                            </p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <img src="{{ asset('assets/home/img/icons/item-6.png') }}" alt="">
                        </div>
                        <div>
								<span>
									Экономия средств
								</span>
                            <p>
                                С нами вы сэкономите денег на доставку, так как вам не придется ехать туда-cюда что бы отвезти что то.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<section class="eight" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-5">
                <h2>Наши <span class="main-color"> контакты </span></h2>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="d-flex align-items-center mt-5">
                    <img src="{{ asset('assets/home/img/icons/contact-1.png') }}" alt="">
                    <ul>
                        <li>Номера телефонов:</li>
                        <li>+7 (700) 577 70 01</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center mt-5">
                    <img src="{{ asset('assets/home/img/icons/contact-2.png') }}" alt="">
                    <ul>
                        <li>Электронная почта</li>
                        <li>info@kenguru-dostavka.kz</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center mt-5">
                    <img src="{{ asset('assets/home/img/icons/contact-3.png') }}" alt="">
                    <ul>
                        <li>Наш адрес:</li>
                        <li>Казахстан, г Алматы</li>
                        <li> Муканова, 113</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="map">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af92eb111d3eb1fec8a3cb67cd677ac7bcd296dc1c151d3736f9e2aa4a36d6875&amp;width=100%&amp;height=399&amp;lang=ru_RU&amp;scroll=false"></script>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="white">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="f-margin">
                    <div class="footer-logo mt-5">
                        <div>
                            <img src="{{ asset('assets/home/img/logo.svg') }}" alt="Logo Image">
                        </div>
                        <div>
                            <p>Курьерская служба в Алматы и Алматинской области</p>
                        </div>
                    </div>
                    <ul>
                        <li>+7 (700) 577 70 01</li>
                        <li>info@kenguru-dostavka.kz</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>

<div class="fab-wrapper">
    <input id="fabCheckbox" type="checkbox" class="fab-checkbox">
    <label class="fab" for="fabCheckbox">
        <span class="fab-dots fab-dots-1"></span>
        <span class="fab-dots fab-dots-2"></span>
        <span class="fab-dots fab-dots-3"></span>
    </label>
    <div class="fab-wheel">
        <a href="#" target="_blank" class="fab-action fab-action-1">
            <img src="{{ asset('assets/home/img/icons/instagram.svg') }}" alt="">
        </a>
        <a href="https://api.whatsapp.com/send?phone=77005777001&text=%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%D1%82%D0%B5%2C%20%D0%BC%D0%BD%D0%B5%20%D0%BD%D1%83%D0%B6%D0%BD%D0%B0%20%D0%B1%D1%8B%D1%81%D1%82%D1%80%D0%B0%D1%8F%20%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0!" class="fab-action fab-action-2">
            <img src="{{ asset('assets/home/img/icons/whatsapp.svg') }}" alt="">
        </a>
        <a href="tel:+77005777001" class="fab-action fab-action-4">
            <img src="{{ asset('assets/home/img/icons/phone2.png') }}" alt="">
        </a>
    </div>
</div>
<div class="modal fade show" id="modal_window" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('feedback') }}" method="POST">
                @csrf
                <!--форма для отправки заявки на почту-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Обратная связь</h5>
                    <p>Оставьте свои контакты, и мы перезвоним вам в ближайшее время!</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" placeholder="имя" required>
                    <input type="text" name="point_a" placeholder="от куда?" required>
                    <input type="text" name="point_b" placeholder="куда?" required>
                    <input type="text" name="phone" placeholder="номер телефона" required>
                    <input type="text" name="text" placeholder="что нужно доставить?" required>
                    <button name="getfeedback" class="btn-1 text-white">Заказать </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="success" class="overlay">
    <div class="popup">
        <span id="modal-title">Ваша заявка оформлена!</span>
        <div class="product-image-cover">
            <img src="{{ asset('assets/home/img/thanks.gif') }}" alt="">
        </div>
        <h2>Наш менеджер свяжется с вами в ближайшее время.</h2>
        <a class="close" href="/">×</a>
    </div>
</div>
<script>
    $('.close-nav').click( function(e) {
        $('.hamburger').removeClass('toggle');
        $('.nav-links').removeClass('open');
        $('.nav-links li').removeClass('fade');
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('assets/home/scripts/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/home/scripts/main.js') }}"></script>
<script>
    $(window).scroll(function() {
        var box1 = $('#fixed-bg').offset().top;
        if(box1 > 50){
            $('.nav-fixed').addClass('fixed-theme');
        } else{
            $('.nav-fixed').removeClass('fixed-theme');
        }
    });
</script>
<script>
    $('.close-nav').click( function(e) {
        $('.hamburger').removeClass('toggle');
        $('.nav-links').removeClass('open');
        $('.nav-links li').removeClass('fade');
    });
</script>
<script>
    $(document).ready(function() {

        typing( 0, $('.typewriter-text').data('text') );

        function typing( index, text ) {

            var textIndex = 1;

            var tmp = setInterval(function() {
                if ( textIndex < text[ index ].length + 1 ) {
                    $('.typewriter-text').text( text[ index ].substr( 0, textIndex ) );
                    textIndex++;
                } else {
                    setTimeout(function() { backed( index, text ) }, 2000);
                    clearInterval(tmp);
                }

            }, 150);

        }

        function backed( index, text ) {
            var textIndex = text[ index ].length;
            var tmp = setInterval(function() {

                if ( textIndex + 1 > 0 ) {
                    $('.typewriter-text').text( text[ index ].substr( 0, textIndex ) );
                    textIndex--;
                } else {
                    index++;
                    if ( index == text.length ) { index = 0; }
                    typing( index, text );
                    clearInterval(tmp);
                }

            }, 150)

        }

    });

</script>
</html>
