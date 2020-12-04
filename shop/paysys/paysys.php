<?php

use PhpPackages\Fs\Dir;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasWidgets;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidget_;
use zetsoft\widgets\former\ZDynaWidget_16_iyun;
use zetsoft\widgets\former\ZDynaWidget_Axror2;
use zetsoft\widgets\former\ZDynaWidgetShah;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Psr7\str;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


//$sit = $this->httpPost('sites');

?>

<div id="page">

    <?php
    // Generator of a terminal request URL as HTML button. PHP example.
    // const URL = 'https://agr.uz/pay'; // Request target LIVE URL

    global $boot;
    //const URL = 'https://agr.uz/pay'; // Request target TEST URL
    //const URL = $boot->env('PaySysUrl');// Request target TEST URL
    const SECRET_KEY = 'PrEe1zL-IY1E4YvdCkawZ0rt61dBPayD'; // Your site SECRET_KEY
    // Array of input parameters
    $params = array(
        'VENDOR_ID' => '101443',
        'MERCHANT_TRANS_ID' => '',
        'MERCHANT_TRANS_AMOUNT' => '1000',
        'MERCHANT_CURRENCY' => 'sum',
        'MERCHANT_TRANS_NOTE' => 'transaction_note_example',
        'MERCHANT_TRANS_DATA' => '',
        'SIGN_TIME' => '',
    );
    $params['SIGN_STRING'] = md5(SECRET_KEY . $params['VENDOR_ID'] .
        $params['MERCHANT_TRANS_ID'] . $params['MERCHANT_TRANS_AMOUNT'] .
        $params['MERCHANT_CURRENCY'] . $params['SIGN_TIME']); // Signature adding
    // Choose one of two options below
    // GET request option. It may not work in IE with more than 2kb transfered data
    /*$url = URL . '?' . http_build_query($params);*/
    /*echo "<button onclick=\"location.href='{$url}';\">Send</button>";*/
    // POST request option

    $PayUrl = $boot->env('PaySysUrl');
    //vdd($PayUrl);
    ?>
    <form target="myIframe" method="post" action="<?=$PayUrl?>">
        <?php foreach ($params as $name => $value): ?>
            <input type="hidden" name="<?= $name ?>" value="<?= $value ?>">
        <?php endforeach; ?>
        <button id="paysys" class="btn btn-success">Send</button>
    </form>

    <iframe class="d-none" name="myIframe" src=""
            width="100%" height="700px" align="center" NORESIZE>Ваш браузер не поддерживает фреймы!
    </iframe>


    <script>
        $('#paysys').on('click', function () {
            $('iframe').addClass('d-block');
            $('#paysys').addClass('d-none');
            /*$.ajax({
                method: 'post',
              /!*  headers: {'Access-Control-Allow-Origin': '/'},
                crossDomain: true,*!/
                url: 'https://agr.uz/sandbox',
                data: {
                    VENDOR_ID: '101443',
                    MERCHANT_TRANS_ID: 'sdas',
                    MERCHANT_TRANS_AMOUNT: '1000',
                    MERCHANT_CURRENCY: 'sum',
                    MERCHANT_TRANS_NOTE: 'note',
                    MERCHANT_TRANS_DATA: '',
                    SIGN_TIME: '',
                },
                success: function (data) {
                    console.log(data);
                   /!* let ifr = document.createElement('iframe');
                    $(ifr).attr('src', 'https://agr.uz/sandbox');
                    $('#if-id').append(ifr);*!/
                    //console.log(data)
                }
            });*/
        })
    </script>





    <?

    /*require(Root . '/upload/cpasz/site.php');*/

    /*$model = new PlaceCountry();
    echo ZDynaWidget_::widget([
        'model' => $model
    ]);*/

    ?>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
