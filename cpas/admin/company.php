<?php

use Faker\Provider\Payment;
use kartik\grid\DataColumn;
use pdima88\uztranslit\UzCyrToLat;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\user\UserPaymentData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\chat\ChatMessage;
use zetsoft\models\cpas\CpasCompany;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\pays\PaysPayment;
use zetsoft\models\pays\PaysWithdraw;
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
 * @author Jahongir Qudratov
 */

$action = new WebItem();

$action->title = Azl . 'Управление компании';
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


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted"><?= Az::l('Управление компании')?></h2>
            <div>
                <a href="/cpas/admin/statistic.aspx" style="font-size: small"><?= Az::l('Главная')?></a>
                <span style="font-size: small">/ <?= Az::l('Управление компании')?></span>
            </div>
        </div>

        <div class="mt-5">

            <?php




            $model = new CpasCompany();
            $model->configs->nameOff = [
                'postback',
                'service',
                'created_at',
                'modified_at',
                'created_by',
                'modified_by',
            ];

            $model->configs->readonly = true;
            $model->columns();

            //vdd(CpasCompany::find()->all());
            //FA::
            echo ZDynaWidget::widget([
                'model' => $model,
                'rightBtn' => [

                    'system' => [
                        'content' => '',
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

                    'search' => false,

                    'toolbar' => [
                        'create'
                    ],
                    'updateUrl' => '{fullUrl}/updateCompany.aspx?id={id}',
                    'viewUrl' => '{fullUrl}/viewCompany.aspx?id={id}',
                    'createUrl' => '{fullUrl}/createCompany.aspx',
                    'columnBefore' => [
                        'action'
                    ],
                    'actionButtons' => [
                        'update',
                        'view',
                        'delete'
                    ],
                    'spaArray' => [
                        'update' => false,
                        //'create' => false
                    ],
                    
                    'columnAfter'=> false,
                    'titleSummary' => false,
                    'isCard' => false,
                    'summary' => true
                ],

            ]);



            ?>


        </div>
    </div>
</div>



<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
