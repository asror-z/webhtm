<?php

use Faker\Provider\Payment;
use kartik\grid\DataColumn;
use pdima88\uztranslit\UzCyrToLat;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\user\UserPaymentData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasBalanceHistoryForm;
use zetsoft\models\chat\ChatMessage;
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

$action->title = Azl . 'История выплат';
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
            <h2 class="text-muted">История выплат</h2>
            <div>
                <a href="/cpas/admin/statistic.aspx" style="font-size: small">Главная</a>
                <span style="font-size: small">/ История выплат</span>
            </div>
        </div>

        <div class="mt-5">

            <?php



            $data = Az::$app->cpas->cpa->getBalanceHistory();
            //vdd($data);


            $model = new CpasBalanceHistoryForm();
            
            $model->configs->order = [
                'date' => SORT_DESC
            ];
            
            $model->columns();


            echo ZDynaWidget::widget([

                'data' => $data,
                'model' => $model,
                'type' => ZDynaWidget::type['form'],

                'config' => [
                    'showFooter' => false,
                    'titleSummary' => true,
                    'isCard' => false,
                    'columnBefore' => [
                        'social'
                    ],
                    'columnAfter' => false,
                    'hasToolbar' => false,
                    'search' => false,
                    'heighbody' => '100%',
                    'summary' => true,
                    'perfectScrollbar' => false,
                    'striped' => true,
                    'hasWidth' => false,
                    
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
