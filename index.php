<!DOCTYPE html>
<html lang="en">

<?php 

$link = mysqli_connect(
    'localhost',
    'root',
    '',
    'web0812'
);
mysqli_set_charset($link , "utf8");

if(!empty($_POST)){
    if(
        !empty($_POST['fio']) && 
        !empty($_POST['email']) && 
        !empty($_POST['phone']) &&
        !empty($_POST['message']) &&
        (
            empty($_POST['reaction']) || 
            !empty($_POST['reaction']) && $_POST['reaction'] <= 5 && $_POST['reaction'] > 0
        )
    ){
        $query = "insert into test(FIO, EMAIL, PHONE, MESSAGE" . (!empty($_POST['reaction']) ? ", REACTION" : '') . ") 
            values('" . htmlspecialchars($_POST['fio']) . "', '" . htmlspecialchars($_POST['email']) . "', 
            '" . htmlspecialchars($_POST['phone']) . "', '" . htmlspecialchars($_POST['message']) . "'" . (!empty($_POST['reaction']) ? ', \'' . htmlspecialchars($_POST['reaction']) . '\'' : '') . ");";
        $res = mysqli_query($link, $query);
        if($res){
            $success = true;
            $_POST = [];
        }
        else{
            $success = false;
        }
    }
}
mysqli_close($link);
?>

<?php if(isset($success) && $success):?>
    <h3>Данные успешно записаны</h3>
<?php elseif(isset($success) && !$success):?>
    <h3>Данные не записаны</h3>
<?php endif;?>

<?php if(!empty($_POST) && (empty($_POST['fio']) || empty($_POST['email']) || empty($_POST['phone'])|| empty($_POST['message']))):?>
    <h3>Не все поля заполнены!</h3>
<?php endif;?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyMoscow</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>	
</head>

<body>
    <nav>
        <div class="nav-wrap">
        <input type="checkbox" id="hamburger" />
        <label for="hamburger" class="hamburger">
            <span></span>
        </label>

        <div class="brand">
            <a href="//localhost/landing/index.php">
            MyMoscow            
            </a>
        </div>

        <label for="hamburger" class="menu-bg">
            <a href="#">Главная</a>
            <a href="#">О компании</a>
            <a href="#">Наши услуги</a>
            <a href="#">Отзвывы</a>
        </label>
        </div>
    </nav>
    <main>
        <section class="slider"> 
            <div class="slides">
                <div class="item">
                    <img src="photos/top.jpg" alt="Первый слайд">
                    <div class="slideText">MyMoscow - агенство интересных маршрутов</div>
                </div>

                <div class="item">
                    <img src="photos/top2.jpg" alt="Второй слайд">
                    <div class="slideText">MyMoscow - незабываемые места</div>
                </div>

                <div class="item">
                    <img src="photos/top3.jpg" alt="Третий слайд">
                    <div class="slideText">MyMoscow - увлекательно проведенное время</div>
                </div>

                <a class="prev" onclick="minusSlide()">&#10094;</a>
                <a class="next" onclick="plusSlide()">&#10095;</a>
        
                <div class="slider-dots">
                    <span class="slider-dots_item" onclick="currentSlide(1)"></span> 
                    <span class="slider-dots_item" onclick="currentSlide(2)"></span> 
                    <span class="slider-dots_item" onclick="currentSlide(3)"></span> 
                </div>
            </div>            
        </section>
        <section class="offers">
            <div class="offer">
                <h3>Что мы предлагаем?</h3>
                <span>Наша главная цель - рассказать о Москве так , чтобы это было интересно всем!</span>
            </div>
            <div>
                <article>
                    <img src="icons/map.png" />
                    <div>
                        <span>Необычные маршруты</span>
                        <span>Мы обязательно порадуем тебя необычными маршрутами Москвы,
                            которые прокладывают наши опытные гиды. Ты увидишь и узнаешь о Москве то,
                            что никогда не знал!</span>
                    </div>
                </article>
                <article>
                    <img src="icons/souvenir.png" />
                    <div>
                        <span>Классные сувениры</span>
                        <span>Отличная новость! У нас появился магазин сувениров!
                            И самое примечательное, что все эти сувениры мы делаем сами!
                            Заходи к нам в гости!</span>
                    </div>
                </article>
                <article>
                    <img src="icons/compass.png" />
                    <div>
                        <span>Интересные экскурсии</span>
                        <span>За время экскурсий, которых у нас больше 20,
                            ты узнаешь и увидишь все основные досопримечательности:
                            Кремль, Храм Христа Спаителя, так и пройдешься по пешеходным улицам Москвы,
                            узнаешь их историю и сделаешь самые классные фотографии.</span>
                    </div>
                </article>
                <article>
                    <img src="icons/picture.png" />
                    <div>
                        <span>Фотосессии в Москве</span>
                        <span>Команда MyMoscow рада провести креативные фотосессии в любом уголке Москвы.
                            Не важно, свадьба у Вас или просто захотелось добавить в альбом или инстаграм
                            красивых фоток.</span>
                    </div>
                </article>
                <article>
                    <img src="icons/discussion.png" />
                    <div>
                        <span>Новые знакомства</span>
                        <span>MyMoscow - это целый клуб, где после московских проулок ты сможешь продолжить общение
                            с теми, кому интересна Москва , знакомиться с новыми людьми и делиться впечатлениями.</span>
                    </div>
                </article>
                <article>
                    <img src="icons/sun.png" />
                    <div>
                        <span>Яркие впечатления</span>
                        <span>Самое важное - это яркие эмоции, которые остануться с тобой на долгое время!
                            Поэтому в нашей команде мы ждем именно тебя!</span>
                    </div>
                </article>
            </div>
        </section>
        <section class="info">
            <img src="photos/group.jpg" alt="О нас">
            <article>
                <div class="wrapper">
                    <h3>Кто мы такие </h3>
                    <span>Мы - команда тех, кто любит историю и любит Москву.</span>
                    <div>Москва – это не только место по «заколачиванию денег» и «взращиванию карьеры»,
                        а еще и бесконечно красивые памятники природы, заказники, парки, заповедники.
                        Активный отдых в Москве и Подмосковье – это отличная возможность вырваться из душного
                        мегаполиса куда-нибудь в «дебри», навстречу приключениям. К счастью, не все Подмосковье
                        еще «облагорожено» асфальтными дорожками и высоченными коттеджными заборами.
                        Еще встречаются места, настолько глухие и далекие, что, очутившись там, кажется,
                        что ты – первый человек, ступивший на эту землю.</div>
                    <div>Там, где не проедет автомобилист и даже велосипедист, найдет лазейку и откроет для себя все
                        красоты 100% бездорожья турист, проводящий свой активный отдых в Подмосковье.
                    </div>
                    <button>Подробнее о нас</button>
                </div>
            </article>
        </section>
        <section class="photo">
            <h3>Москва в фотографиях</h3>
            <div>Проще всего рассказать обо всем в фотографиях. Смотрите наши фотоотчеты и присылайте нам свои
                фотографии.</div>
            <article>
                <div>
                    <div>
                        <img src="photos/1.jpg" alt="">
                        <img src="photos/2.jpg" alt=""></div>
                    <div><img src="photos/3.jpg" alt="">
                        <img src="photos/4.jpg" alt=""></div>
                </div>
                <div>
                    <div>
                        <img src="photos/5.jpg" alt="">
                        <img src="photos/6.jpg" alt=""></div>
                    <div><img src="photos/7.jpg" alt="">
                        <img src="photos/8.jpg" alt=""></div>
                </div>
            </article>
        </section>
        <section class="reviews">
            <h3>Отзывы</h3>
            <div>
                <article>
                    <div>Были с дочкой и подругой на ночной экскурсии.
                        Все таки как много зависит от экскурсовода!
                        Мы все четыре часа ходили за Станиславом Симоновым, как кролики.
                        Боялись пропустить хоть одно слово. При этом моей дочке - которая побывала
                        во многих местах и с детства искушенная на интересные события - была сильно
                        увлечена.</div>
                    <div class="user">
                        <img src="testimonials/test2.jpg" alt="Екатерина">
                        <span>Екатерина Васильева</span>
                    </div>
                </article>
                <article>
                    <div>Ездили на экскурсию с семиклассниками и родителями. Всем очень понравилось!
                        Экскурсовод Михаил Борисович очень интересно, необычно и с юмором рассказывал о
                        Москве 16 века. Гибко подстраивал эксукурсию под интересы и потребности слушателей,
                        ловко «управлял» подачей автобуса, не давая нам замёрзнуть.) Огромное спасибо!
                    </div>
                    <div class="user">
                        <img src="testimonials/test1.jpg" alt="Анна">
                        <span>Анна крушевская</span>
                    </div>
                </article>
            </div>
        </section>


        <section class="form">
            <form method="post" action="">
                <h3>Напишите нам</h3>
                <div class="row">
                    <div class="col">
                        <input type="text" name="fio" placeholder="ФИО" required/>
                        <input type="email" name="email" placeholder="Email" required/>
                        <input type="text" name="phone" placeholder="Телефон" required/>
                    </div>
                    <div class="col">
                        <textarea name="message" placeholder="Ваше сообщение" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit">отправить вопрос</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <section>
            <div class="wrapper">
                <article>
                    <div class="logo">
                        <img src="icons/spasskaya-tower.png" alt="логотип">
                        <h3>MyMoscow</h3>
                    </div>
                    <div class="invitation">Мы приглашаем тебя на самые разные экскурсии по Москве.
                        Автобусные и пешеходные, на целый день или на несколько часов,
                        на свежем воздухе или с заходом в здания - у нас в ассортименте более
                        20 авторских экскурсий по Москве, выбирай и узнавай Москву вместе с нами!</div>
                </article>
                <article>
                    <h3>Контакты</h3>
                    <span>
                        <img src="icons/placeholder.png" />
                        <address>Москва, Большая Спасская 12</address>
                    </span>
                    <span>
                        <img src="icons/mail.png" />
                        <a href="mailto:moscow@imoscow.ru">moscow@imoscow.ru</a>
                    </span>
                    <span>
                        <img src="icons/telephone.png" />
                        <a href="tel:84956264600">8 (495) 626-46-00</a>
                    </span>
                </article>
                <article>
                    <h3>Последние новости</h3>
                    <div class="lastnews">
                        <div>Curabitur felis nibh, lacinia non rhoncus vel, lobortis et lorem.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Suspendisse sit amet<br><span>5 марта 2018</span></div><br>
                        <div>Curabitur felis nibh, lacinia non rhoncus vel, lobortis et lorem.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per <br><span>12 декабря
                                2017</span></div>
                    </div>
                </article>
            </div>
        </section>
        <div class="lastwrap">
            <div>
                <span>2020 Все права защищены</span>
                <span>Designed by Nordic IT School</span>
                <div class="social">
                    <a href="#vk">
                        <img src="social/vk.png" alt=""></a>
                    <a href="#facebook">
                        <img src="social/facebook.png" alt=""></a>
                    <a href="#instagram">
                        <img src="social/instagram.png" alt=""></a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>