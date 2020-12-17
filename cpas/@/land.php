<?php

use kartik\daterange\DateRangePicker;
use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\drag\DragFormDb;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\phone\ZSipml5Widget44;
use zetsoft\widgets\phone\ZSipml5WidgetX;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';;


echo ZNProgressWidget::widget([]);
      $this->fileCss('/render/blocks/cpa/main.css')

?>

<div id="page">

    <?
   // require Root . '/webhtm/block/navbar/admin.php';
    echo ZSessionGrowlWidget::widget();?>



    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-jump">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="row">

            <div class="header-logo">
                <a class="site-logo" href="index.html">ZetSoft LLC</a>
            </div>

            <nav class="header-nav-wrap">
                <ul class="header-nav">
                    <li><a class="smoothscroll"  href="#about" title="about">О нас</a></li>
                    <li><a class="smoothscroll"  href="#services" title="services">Услуги</a></li>
                    <li><a class="smoothscroll"  href="#works" title="works">Проекты</a></li>
                    <li><a class="smoothscroll"  href="#contact" title="contact">Контакты</a></li>
                </ul>
            </nav> <!-- end header-nav-wrap -->

        </div> <!-- end row -->

    </header> <!-- end s-header -->


    <!-- home
    ================================================== -->
    <section id="home" class="s-home page-hero target-section" data-parallax="scroll" data-image-src="images/hero-bg.jpg" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

        <div class="shadow-overlay"></div>

        <div class="home-content">

            <div class="row home-content__main">

                <h1>
                    Мы предоставляем креатив решения, чтобы превратить ваш
                    идеи в цифровую реальность
                </h1>


            </div> <!-- end home-content__main -->

            <div class="home-content__scroll">
                <a href="#about" class="scroll-link smoothscroll">
                </a>
            </div>

        </div> <!-- end home-content -->

        <ul class="home-social">
            <li>
                <a href="https://www.facebook.com/zetsoftllc"><i class="fab fa-facebook-f" aria-hidden="true"></i><span>Facebook</span></a>
            </li>
            <li>
                <a href="https://www.instagram.com/zetsoft_ll"><i class="fab fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
            </li>
            <li>
                <a href="https://t.me/zetsoft_team"><i class="fab fa-telegram" aria-hidden="true"></i><span>Telegram</span></a>
            </li>
        </ul> <!-- end home-social -->

    </section> <!-- end s-home -->


    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 data-num="01" class="subhead">КТО МЫ</h3>
                <h1 class="display-1">
                    ZETSOFT — инновационная IT компания в Ташкенте, работающая по методологиям Scrum/Kanban, предлагает своим клиентам широкий спектр услуг по комплексной поддержке бизнеса клиентов на долгосрочной основе:
                </h1>
                <p class="lead">

                </p>
            </div>
        </div>


    </section> <!-- end s-about -->


    <!-- services
    ================================================== -->
    <section id="services" class="s-services target-section">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 data-num="02" class="subhead">Что мы делаем</h3>
                <h1 class="display-1 display-1--light">
                    Наши услуги разработаны так, чтобы ваш бизнес рос и выделялся.
                </h1>
                <p class="lead lead-light">

                </p>
            </div>
        </div>

        <div class="row services-list block-1-3 block-m-1-2 block-tab-full">

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Разработка веб сайтов и интерактивных веб приложений</h4>
                <p>
                    Регистрация доменного имени, хостинг и выбор сервера с оптимально подходящими настройками, создание концепции сайта, дизайн самой разной сложности, создание моделей страниц и карты сайта, веб-программирование, тестирование, обновление, управление контентом, оптимизация сайта в поисковых системах, веб-маркетинг, и др.
                </p>
            </div>

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Разработка информационных систем для автоматизации бизнес-процессов</h4>
                <p>
                    Использование оптимальной технологии, системное планирование, создание прототипа продукта, разработка программного обеспечения, тестирование, внедрение, постоянная поддержка, создание необходимой документации, дизайн и др.
                </p>
            </div>

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Разработка кроссплатформенных приложений для мобильных устройств.</h4>
                <p>
                    Создаем нативные мобильные приложения и кроссплатформенные гибридные приложения непревзойденного качества. Пишем легко поддерживаемый и расширяемый код, который отвечает всем требованиям гайдлайнов Apple, рекомендациям Android и Material Design.
                </p>
            </div>

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Услуги по вводу и управлению данными</h4>
                <p>
                    Постоянное обновление новостей и другой аналитической информации; проведение и обработка опросников стала неотъемлемой частью Процесса Передачи. Информации и Маркетинговых исследований - в нашем штате имеются специалисты, предназначенные для исполнения такого рода заданий.
                </p>
            </div>

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Разработка фирменного стиля</h4>
                <p>
                    фирменных логотипов, буклеты компании, дизайн бланков, визиток, бланки компании. Разработка дизайна презентации.
                </p>
            </div>

            <div class="col-block item-service" data-aos="fade-up">
                <h4>Продвижения Вашего товара по Digital маркетингу</h4>
                <p>
                    SMM, SEO, Landing, CPC, СPM, и т.д
                </p>
            </div>





        </div> <!-- end services-list -->

    </section> <!-- end s-services -->


    <!-- works
    ================================================== -->
    <section id="works" class="s-works target-section">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 data-num="03" class="subhead">ПОСЛЕДНИЕ РАБОТЫ</h3>
                <h1 class="display-1">
                    Вот некоторые из наших любимых проектов, которые мы сделали в последнее время. Не стесняйтесь проверить их.
                </h1>
            </div>
        </div>

        <div class="portfolio block-1-4 block-m-1-3 block-tab-1-2 collapse">

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/Time of sale/time of sale.png" class="thumb-link" data-size="1050x700">
                        <img src="images/Time of sale/time of sale.png"
                             srcset="images/Time of sale/time of sale.png@2x.png 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        Time Of Sales
                    </h3>
                    <p class="item-folio__cat">
                        Колл-центр
                    </p>
                </div>

                <a href="http://timeofsales.ru/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Колл-центр Time Of Sales предлагает услуги по приему входящих звонков и обзвону клиентов. В нашем распоряжении есть современное оборудование, которое позволяет одновременно обрабатывать огромное количество вызовов.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/Accoola/accoola.png" class="thumb-link" title="Fuji" data-size="1050x700">
                        <img src="images/Accoola/accoola.png"
                             srcset="images/Accoola/accoola.png 1x, images/Accoola/accoola@2x.png 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        ACCOOLA
                    </h3>
                    <p class="item-folio__cat">
                        CORPARATION
                    </p>
                </div>

                <a href="http://accoola.uz/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Мы предлагаем Вам комплексное бухгалтерское сопровождение Вашей организации, которое имеет ряд стоимостных и качественных преимуществ по сравнению с наймом собственного бухгалтера.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/SIBEX/sibex.png" class="thumb-link" title="Woodcraft" data-size="1050x700">
                        <img src="images/SIBEX/sibex.png"
                             srcset="images/SIBEX/sibex.png 1x, images/SIBEX/sibex@2x.png 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        SIBEX
                    </h3>
                    <p class="item-folio__cat">
                        LOGISTICS COMPANY
                    </p>
                </div>

                <a href="http://www.sibex.uz/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Собственный склад. Экономьте на аренде.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/komus contact/komus contact.png" class="thumb-link" title="Droplet" data-size="1050x700">
                        <img src="images/komus contact/komus contact.png"
                             srcset="images/komus contact/komus contact.png 1x, images/komus contact/komus contact@2x.png 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        KOMUS
                    </h3>
                    <p class="item-folio__cat">
                        CONTACT
                    </p>
                </div>

                <a href="https://www.komus-contact.ru/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Жаркий сезон - жаркие цены!
                        Специальное предложение
                        на исходящие услуги.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/NTL group/ntl.png" class="thumb-link" title="Shutterbug" data-size="1050x700">
                        <img src="images/NTL group/ntl.png"
                             srcset="images/NTL group/ntl.png 1x, images/NTL group/ntl@2x.png 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        NTL
                    </h3>
                    <p class="item-folio__cat">
                        GROUP
                    </p>
                </div>

                <a href="https://ntl.group/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>ГРУЗОПЕРЕВОЗКИ ИЗ КИТАЯ, Ю.КОРЕИ, ТУРЦИИ И ЕВРОПЫ
                        НАШИ ЦЕНЫ НА 20% НИЖЕ
                        100% ГАРАНТИЯ СОХРАННОСТИ ГРУЗА
                        ДОСТАВКА ТОЧНО В СРОК</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/portfolio/gallery/g-minimalismo.jpg" class="thumb-link" title="Minimalismo" data-size="1050x700">
                        <img src="images/portfolio/minimalismo.jpg"
                             srcset="images/portfolio/minimalismo.jpg 1x, images/portfolio/minimalismo@2x.jpg 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        Minimalismo
                    </h3>
                    <p class="item-folio__cat">
                        UX Design
                    </p>
                </div>

                <a href="https://www.behance.net/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde dolorem corrupti neque nisi.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/portfolio/gallery/g-film.jpg" class="thumb-link" title="Film" data-size="1050x700">
                        <img src="images/portfolio/film.jpg"
                             srcset="images/portfolio/film.jpg 1x, images/portfolio/film@2x.jpg 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        Film
                    </h3>
                    <p class="item-folio__cat">
                        Branding
                    </p>
                </div>

                <a href="https://www.behance.net/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde dolorem corrupti neque nisi.</p>
                </div>

            </div> <!-- end item-folio -->

            <div class="col-block item-folio" data-aos="fade-up">

                <div class="item-folio__thumb">
                    <a href="images/portfolio/gallery/g-skaterboy.jpg" class="thumb-link" title="Skaterboy" data-size="1050x700">
                        <img src="images/portfolio/skaterboy.jpg"
                             srcset="images/portfolio/skaterboy.jpg 1x, images/portfolio/skaterboy@2x.jpg 2x" alt="">
                    </a>
                </div>

                <div class="item-folio__text">
                    <h3 class="item-folio__title">
                        Skaterboy
                    </h3>
                    <p class="item-folio__cat">
                        Web Design
                    </p>
                </div>

                <a href="https://www.behance.net/" class="item-folio__project-link">
                    Ссылка Сайта
                </a>

                <div class="item-folio__caption">
                    <p>Vero molestiae sed aut natus excepturi. Et tempora numquam. Temporibus iusto quo.Unde dolorem corrupti neque nisi.</p>
                </div>

            </div> <!-- end item-folio -->



        </div> <!-- end portfolio -->


        <!-- <div class="testimonials-wrap" data-aos="fade-up">

             <div class="row">
                 <div class="col-full testimonials-header">
                     <h2 class="h1">Что говорят клиенты ...</h2>
                 </div>
             </div>

             <div class="row testimonials">

                 <div class="col-full testimonials__slider">

                     <div class="testimonials__slide">
                         <span class="testimonials__icon"></span>
                         <p>Ребята!!! Спасибо огромное!!!! Все отлично!!!</p>
                         <div class="testimonials__author">
                             <img src="images/avatars/user-01.jpg" alt="Author image" class="testimonials__avatar">
                             <span class="testimonials__name">Tim Cook</span>
                             <span class="testimonials__position">CEO, Apple</span>
                         </div>
                     </div> &lt;!&ndash; end testimonials__slide &ndash;&gt;

                     <div class="testimonials__slide">
                         <span class="testimonials__icon"></span>
                         <p>Большое спасибо Zetsoft за оперативность, отзывчивость и в итоге качественный сайт с понятным администрированием)) </p>
                         <div class="testimonials__author">
                             <img src="images/avatars/user-05.jpg" alt="Author image" class="testimonials__avatar">
                             <span class="testimonials__name">Sundar Pichai</span>
                             <span class="testimonials__position">CEO, Google</span>
                         </div>
                     </div> &lt;!&ndash; end testimonials__slide &ndash;&gt;

                     <div class="testimonials__slide">
                         <span class="testimonials__icon"></span>
                         <p>Ребята!Спасибо за ваш труд, вы огромные умнички! Все сделали очень классно.</p>
                         <div class="testimonials__author">
                             <img src="images/avatars/user-02.jpg" alt="Author image" class="testimonials__avatar">
                             <span class="testimonials__name">Satya Nadella</span>
                             <span class="testimonials__position">CEO, Microsoft</span>
                         </div>
                     </div> &lt;!&ndash; end testimonials__slide &ndash;&gt;

                 </div> &lt;!&ndash; end testimonials__slider &ndash;&gt;

             </div>

         </div> -->

    </section> <!-- end s-works -->


    <!-- clients
    ================================================== -->
    <section id="clients" class="s-clients target-section">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 data-num="04" class="subhead">Выбранные клиенты</h3>
                <h1 class="display-1 display-1--light">Вот некоторые бренды, с которыми мы имели честь работать</h1>
            </div>
        </div>

        <div class="row clients-list block-1-4 block-tab-1-3 block-mob-1-2" data-aos="fade-up">

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img class="img-logo" src="images/sibex.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img class="img-logo" src="images/clean-pure.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img src="images/accoola.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img class="img-logo" src="images/zetsoft.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img src="images/arbit-pro.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img src="images/logo.png" alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img src="images/ntl-group.png  " alt="">
                </a>
            </div>

            <div class="col-block item-client">
                <a href="#0" class="img__logo">
                    <img class="img-logo1" src="images/Time of sale/time of sale logo2.png" alt="">
                </a>
            </div>

        </div> <!-- clients-list -->

    </section> <!-- end s-clients -->


    <!-- stats
    ================================================== -->
    <section id="stats" class="s-stats">

        <div class="row stats-block block-1-4 block-m-1-2 block-mob-full" data-aos="fade-up">

            <div class="col-block item-stats ">
                <div class="item-stats__count">213</div>
                <h5>Завершенные проекты</h5>
            </div>
            <div class="col-block item-stats">
                <div class="item-stats__count">179</div>
                <h5>Счастливые клиенты</h5>
            </div>
            <div class="col-block item-stats">
                <div class="item-stats__count">35</div>
                <h5>Полученные награды</h5>
            </div>
            <div class="col-block item-stats">
                <div class="item-stats__count">2319</div>
                <h5>Чашки кофе</h5>
            </div>

        </div> <!-- end stats -->

    </section> <!-- end s-stats -->


    <!-- contact
    ================================================== -->
    <section id="contact" class="s-contact target-section">

        <div class="row section-header" data-aos="fade-up">
            <div class="col-full">
                <h3 data-num="05" class="subhead">СВЯЗАТЬСЯ</h3>
                <h1 class="display-1 display-1--light">Имейте идею или эпический проект? Поговори с нами. Давайте работать вместе и сделать что-то великое. Напишите нам на
                    <a href="https://www.google.com/intl/ru/gmail/about/">zetsoft.info@gmail.com</a></h1>
            </div>
        </div>

        <div class="row contact-infos">

            <div class="col-five md-seven tab-full contact-address" data-aos="fade-up">
                <h4>Где нас найти</h4>

                <p>
                    ул. Сухайл, 13, Ташкент, Узбекистан
                </p>
            </div>

            <div class="col-three md-five tab-full contact-social" data-aos="fade-up">
                <h4>Подписывайтесь</h4>

                <ul class="contact-list">
                    <li><a href="https://www.facebook.com/zetsoftllc">Facebook</a></li>
                    <li><a href="https://www.instagram.com/zetsoft_ll/">Instagram</a></li>
                    <li><a href="https://t.me/zetsoft_team">Telegram</a></li>
                </ul>
            </div>

            <div class="col-four md-six tab-full contact-number" data-aos="fade-up">
                <h4>Связаться с нами</h4>

                <ul class="contact-list">
                    <li><a href="https://www.google.com/intl/ru/gmail/about/">zetsoft.info@gmail.com</a></li>
                    <li><a href="tel:998974037243">+998 97 403 72 43</a></li>
                    <li><a href="tel:998974037243">+998 97 403 72 43</a></li>
                </ul>
            </div>

        </div> <!-- end contact-infos -->
    </section> <!-- end s-contact -->


    <!-- footer
    ================================================== -->
    <footer>
        <div class="row">
            <div class="col-full cl-copyright">
                <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
     Авторское право &copy;<script>document.write(new Date().getFullYear());</script>
    Все права защищены | <a href="https://zetsoft.com" target="_blank">ZetSoft</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </span>
            </div>
        </div>

        <div class="cl-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>
    </footer>


    <!-- photoswipe background
    ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div><!-- end photoSwipe background -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>





</div>
</div>
    

    <!--SIPML5 begin-->

    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>




<style>
    .main_block .block_item:last-child {
        width: 100%;
    }

    .main_block .or2 {
        padding-top: 0;
    }

    .main_block .block_item:first-child {
        height: auto;
    }
</style>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
