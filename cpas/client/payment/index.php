<?php

use Faker\Provider\Payment;
use kartik\grid\DataColumn;
use pdima88\uztranslit\UzCyrToLat;
use zetsoft\dbdata\user\UserPaymentData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\pays\PaysPayment;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetJahongir;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Реквизиты';
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>

<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

echo $this->require('\webhtm\cpas\blocks\header.php')
?>

<div id="page">
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">

            <?php

            $model = new PaysPayment();

            $model->configs->query = PaysPayment::find()
                ->where([
                    'user_id' => $this->userIdentity()->id
                ]);

         

            // vdd($model2);

            $model->configs->nameOn = [
               // 'id',
               'name',
                'form',
                //'value',
                /*'confirm',
                'active',*/
                'created_at'
            ];


            $model->configs->readonly = true;

            $model->columns();

            echo ZDynaWidget::widget([

                'model' => $model,

                'rightNameEx' => [
                    'system'
                ],

                'rightBtn' => [

                    'system' => [
                        'content' => '{system}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'toggleData' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],

                    'statistics' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'add-clone-delete' => [
                        'content' => '{add}',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                    'export' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                    ],
                    'filter-sort-id' => [
                        'content' => '',
                        'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                    ],

                ],


                'config' => [

                    'pjax' => false,

                    'search' => false,

                    'toolbar' => [
                        'create'
                    ],

                    'hastollbar' => false,

                    'updateUrl' => '/cpas/client/payment/paymentUpdate.aspx',
                    
                    'createUrl' => '/cpas/client/payment/payment.aspx',

                    'columnBefore' => [
                        'social'
                    ],
                    'columnAfter' => false,
                    'striped' => false,

                ],

            ]);


            ?>


        </div>

        <? echo $this->require('\webhtm\cpas\blocks\footer.php'); ?>
        <?php $this->endBody() ?>

        <? echo $this->require('\webhtm\cpas\blocks\footer.php'); ?>

        <? $this->endBody(); ?>
</body>

</html>


<?php $this->endPage() ?>
