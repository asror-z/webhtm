<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasStream;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZListViewWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 * @author Jakhongir Kudratov
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

echo $this->require( '\webhtm\cpas\blocks\header.php');
?>
    <div class="container-fluid">
        <div class="mt-2">
            <div>
                <a href="/cpas/client/statistic.aspx" style="font-size: small"><?= Az::l('Главная')?></a>
                <span style="font-size: small">/ <?= Az::l('API документация')?></span>
                    
            </div>



               <h3><?= Az::l('Пример на php')?></h3>
               <p>
                   Url : http://arbit.zetsoft.uz/api/cpas/lead/create-lead.aspx
               </p>

            <pre class="border p-3 bg-white">
                const MAIN_URL = 'http://arbit.zetsoft.uz/api/cpas/lead/create-lead.aspx';
                const AUTH_KEY = '2e9j4VmA4bCDxwpDfcMjRhYZDsHCEug89wGus47DNqGmWnNW3NyJwXqttfrebpXR';
                const OFFER_ID = 12352;
                const ITEM_ID = 302;
                const THANKS = 'thanks.php';

                if (!empty($_POST)) {

                    $customer = urldecode($_POST['name']);
                    $tel = urldecode($_POST['number']);

                    $params = array(
                        'shop_catalog_id' => OFFER_ID,
                        'user_name' => $customer,
                        'user_phone' => $tel,
                        'item_id' => ITEM_ID,
                        'ip' => getUserIpAddr(),
                    );

                    $authorization = "Authorization: Bearer {".AUTH_KEY."}";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization ));
                    curl_setopt($ch, CURLOPT_URL, MAIN_URL);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

                    $return = curl_exec($ch);
                    curl_close($ch);

                    header("Location: thanks.php");
                }

                function getUserIpAddr(){

                    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
                        //ip from share internet
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                        //ip pass from proxy
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    }else{
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                }
            </pre>

            <div class="container">


                <h2>Katalog Id</h2>
                <img src="/render/cpaapp/api_images/catalog_id.jpg" class="img-fluid">
                <h2>Item Id</h2>
                <img src="/render/cpaapp/api_images/item_id.jpg" class="img-fluid">
                <h2>profil</h2>

                <img src="/render/cpaapp/api_images/user_profile.jpg" class="img-fluid">
                <h2>auth key</h2>

                <img src="/render/cpaapp/api_images/auth_key.jpg" class="img-fluid">
            </div>

           
        </div>
    </div>
<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
