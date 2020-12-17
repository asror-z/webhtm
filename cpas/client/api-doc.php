<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\place\PlaceRegion;
use zetsoft\service\cores\Date;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKDatepickerWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use kartik\widgets\DateTimePicker;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Jakh Kudratov
 */

$action = new WebItem();

$action->title = Azl . 'API документация';
$action->icon = 'fa fa-globe';
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

<body class="hold-transition sidebar-mini">

<?php
$this->beginBody();
echo $this->require('\webhtm\cpas\blocks\header.php')
?>

<div class="container-fluid">

  <div class="row">

    <div class="col-md-12">
      <p>Ссылка: <a target="_blank" href="http://arbitpro.com/api/cpas/lead/create-lead.aspx">http://arbitpro.com/api/cpas/lead/create-lead.aspx</a>
      </p>
      <p>Аутентификация через беарер токен</p>
      <p>Метод: POST</p>
      <p>Требуемые параметры:</p>
      <ul>
        <li>shop_catalog_id - Оффер ид</li>
        <li>user_name - Имя клиента</li>
        <li>user_phone - Номер телефона клиента</li>
        <li>item_id - Ид элемент потока</li>
        <li>ip - Ип адрес клиента</li>
      </ul>
      <p>Для получения <b>код</b> аутентификации:</p>
      <img src="/render/cpaapp/api_images/click_profile.png" class="img-fluid">
      <img src="/render/cpaapp/api_images/auth_key.png" class="img-fluid">
      <p>Для получения <b>shop_catalog_id</b>:</p>
      <p>Ссылкa: <a target="_blank" href="http://arbitpro.com/cpas/client/offer.aspx">http://arbitpro.com/cpas/client/offer.aspx</a>
      </p>
      <img src="/render/cpaapp/api_images/shop_catalog_id.png" class="img-fluid">
      <p>Для получения <b>item_id</b>:</p>
      <p>Ссылкa: <a target="_blank" href="http://arbitpro.com/cpas/client/flows.aspx">http://arbitpro.com/cpas/client/flows.aspx</a>
      </p>
      <img src="/render/cpaapp/api_images/item_id.png" class="img-fluid">
      <div class="row">
        <div class="col-md-6">
          <p>Для получения <b>Ип адрес на PHP</b>:</p>
          <pre>
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
      </pre>
        </div>
        <div class="col-md-6">
          <p>Для получения <b>Ип адрес на JavaScript</b> прочитайте <a href="https://stackoverflow.com/a/35123097">статью</a></p>
          <pre>
             $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
              var ip = data['geobytesremoteip'];
              });
          </pre>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p>Пример в PHP: </p>
          <pre style="overflow: hidden;">
          $curl = curl_init();
          if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
          } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          } else {
              $ip = $_SERVER['REMOTE_ADDR'];
          }
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://arbitpro.com/api/cpas/lead/create-lead.aspx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('shop_catalog_id' => '40','user_name' => 'test1','user_phone' => '1245125125','item_id' => '123','ip' => $ip),
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer ugshpmZybDuZct4eNfZqpyzgxUTvEF8WxrtqXHhEksQC32ZZmka4C3CQsP3AgHfZ'
            ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          echo $response;
      </pre>
        </div>
        <div class="col-md-6">
          <p>Пример на JavaScript(Jquery)</p>
          <pre>
         $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
          var ip = data['geobytesremoteip'];
          });
        var form = new FormData();
        form.append("shop_catalog_id", "40");
        form.append("user_name", "test1");
        form.append("user_phone", "1245125125");
        form.append("item_id", "123");
        form.append("ip", ip);

        var settings = {
          "url": "http://arbitpro.com/api/cpas/lead/create-lead.aspx",
          "method": "POST",
          "timeout": 0,
          "headers": {
            "Authorization": "Bearer ugshpmZybDuZct4eNfZqpyzgxUTvEF8WxrtqXHhEksQC32ZZmka4C3CQsP3AgHfZ"
          },
          "processData": false,
          "mimeType": "multipart/form-data",
          "contentType": false,
          "data": form
        };

        $.ajax(settings).done(function (response) {
          console.log(response);
        });
      </pre>
        </div>
      </div>


    </div>

  </div>

</div>
<?php
//end|JakhongirKudratov|

echo $this->require('\webhtm\cpas\blocks\footer.php');
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>