<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;

use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMenuItemWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

/**
 *
 * @license JaloliddinovSalohiddin
 * @author  OtabekNosirov
 * @license AkromovAzizjon
 */

/** @var ZView $this */
$action = new WebItem();

//$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);
$this->title();
$this->beginPage();

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php
/*    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php'; */

    $this->head();
    ?>
    <title>Jinsiy hayot uchun sinovdan o'tgan retsept</title>
    <link rel="shortcut icon" href="favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="/render/cpa/css/style.css">

</head>

<body>

<section>
    <div class="logo"><img src="/render/cpa/img/logo.png"/> <a href="#order">Buyurtma qiling</a></div>
    <div class="brosayte"><b>Viagradan yaxshiroq vosita orqali Sevimli ishingiz bilan kamida 2 soat
            shug'ullaning.</b></div>
    <div class="nikostop"><img src="/render/cpa/img/nico.jpg"/></div>

    <div class="skidka"><span>bugun chegirma <b>84%</b></span>
        <h4>119 000 <small>so'm</small></h4>
        <h3>18 000 <small>so'm</small></h3>
    </div>

    <div class="comparison">
        <img src="/render/cpa/img/02.jpg" alt="" style="width: 100%;height: auto">
    </div>
    <p style="margin:40px;">Agar ayol sizga uzoq jinsiy aloqa, bo'shanish va yorqin hislar haqida qayg'urmasligini
        aytsa, ishonasizmi?

        Biz — yo'q!

        Ko'nikmalar va tajribalar sizni ajoyib ishqibozga aylantirishi mumkin, ammo faqat temir erektsiya bilan siz
        jinsiy aloqada haqiqiy Tulpor bo'lishingiz mumkin!

    </p>
    <div>
        <img src="/render/cpa/img/sostav.jpg" alt="" style="width: 100%;height: auto">
    </div>

    <div>
        <h2>QO'LLANISH USULI</h2>
        <p> Kuniga 3 maxal, 1 ta kapsuladan ovqatdan 15-20 minut oldin ichiladi. Davolanish kursi 30 kun, vositani 15
            kun iste'mol qilganizdan keyin sezilarli natija paydo bo'ladi.
        </p>
    </div>
    <img src="/render/cpa/img/doc.jpg" alt=""  style ="width: 100% ; height:auto;">
    <div class="testimonials">
        <h2>FIKRLAR</h2>
        <img src="/render/cpa/img/t1.jpg" alt="">
        <img src="/render/cpa/img/t2.jpg" alt="">
        <img src="/render/cpa/img/t3.jpg" alt="">
    </div>
    <div class="skidka">
        <h2>Davolashning to'liq kursini o'tash bilan maksimal ta'sirga erishiladi! <br/></h2>
        <h2>Anonimlik maqsadida telefon raqamlar yashirilgan!</h2>
        <span>bugun chegirma <b>84%</b>
            </span>
        <h4>119 000 <small>SO'M</small></h4>
        <h3>18 000 <small>SO'M</small></h3>
    </div>

    <div class="ostatok" id="remaining">
        <p>57 dona qoldi</p>
    </div>
    <div class="forma">
        <p>MA'LUMOTLARINGIZNI TO'LIQ MAXFIYLIGINI KAFOLATLAYMIZ!</p>
        <div class="message"></div>
        <form class="order-form" id="order">
            <label>Ismingiz:(Misol uchun: Shavkat Rahmanov)</label>
            <input id="name" type="text"/>
            <label for="amount">Miqdordini kiriting:</label>
            <input id="amount" type="number" min="0" inputmode="tel" value="1" placeholder=""/>
            <div class="input_tel">
                <label>Telefon raqamingiz:</label>
                <input id="phone" type="text" inputmode="tel" placeholder=""/>
            </div>

            <input class="submitBtn" type="button" value="Buyurtma qilish"/>
        </form>
    </div>
    <div class="copy">
        <p>2020 | Barcha huquqlar himoyalangan ©</p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script type="text/javascript">

    $('.submitBtn').click(function () {
        // собираем данные с формы

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        let subid = urlParams.get('subid');
        let catalog_id = 1514;
        var name = $('#name').val();
        var number = $('#phone').val();
        var amount = $('#amount').val();
        // отправляем данные
        $.ajax({
            type: "get", // метод передачи
            //url: "/api/cpa/get-order.aspx", // куда отправляем
            //url: "call.php", // куда отправляем
            //dataType: "json", // тип передачи данных
            url:"/api/shop/cart/add-order.aspx?email=123@gmail.com&password=12345678&catalog_id="+catalog_id+"&user_name="+name+"&user_phone="+number+"&amount="+amount,
            /*data: { // что отправляем
                "name": name,
                "number": number,
                "amount":amount ,
                "subid":subid ,
                "catalog_id":catalog_id
            }*/
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            crossDomain : true,
            xhrFields: {
                withCredentials: true
            },
            // после получения ответа сервера
            success: function (data) {
                $('.message').html(data.result); // выводим ответ сервера
            }
        });
    });
</script>

</body>
</html>
<? $this->endPage() ?>
