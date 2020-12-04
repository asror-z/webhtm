<?php

use Faker\Provider\Payment;
use kartik\grid\DataColumn;
use pdima88\uztranslit\UzCyrToLat;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\user\UserPaymentData;
use zetsoft\dbitem\core\WebItem;
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

$action->title = Azl . 'Управление выплатами';
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
            <h2 class="text-muted"><?= Az::l('Управление выплатами')?></h2>
            <div>
                <a href="/cpas/admin/statistic.aspx" style="font-size: small"><?= Az::l('Главная')?></a>
                <span style="font-size: small">/ <?= Az::l('Управление выплатами')?></span>
            </div>
        </div>

        <div class="mt-5">

            <?php



           
            $model = new \zetsoft\models\pays\PaysWithdraw();

            $model->configs->order = [
                'id' => SORT_DESC
            ];

            $model->configs->nameOn = [
                    'user_id',
                    'pays_payment_id',
                    'amount',
                    'status'
            ];

            $model->configs->readonly = true;

            $model->configs->after = [
                'status' => [
                    [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Управление выплату'),
                        'width' => '200px',
                        'mergeHeader' => false,
                        'value' => function ($paysWithdraw, $key, $index, DataColumn $dataColumn) use ($model) {
                                if (ZArrayHelper::getValue($paysWithdraw, 'status') === 'hold')
                                {
                                $cancel = ZButtonWidget::widget([
                                    'config' => [
                                        'url' => '/cpas/admin/cancelPay.aspx?id='.ZArrayHelper::getValue($paysWithdraw, 'id'),
                                        'title' => Az::l('Отменить'),
                                        'text' => Az::l('Отменить'),
                                        'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                                        'btnRounded' => false,

                                    ]
                                ]);

                                $accept = ZButtonWidget::widget([
                                    'config' => [
                                        'url' => '/cpas/admin/acceptPay.aspx?id='.ZArrayHelper::getValue($paysWithdraw, 'id'),
                                        'title' => Az::l('Принять'),
                                        'text' => Az::l('Принять'),
                                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                        'btnRounded' => false,
                                    ]
                                ]);

                                $btn = '<div class="btn-group" role="group">';
                                $btn .= $accept.$cancel;
                                $btn .= '</div>';

                                return $btn;

                                }

                                return null;

                        }
                    ],
                ],

            ];

            $model->columns();
            //FA::
            echo ZDynaWidget::widget([

                'model' => $model,

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
                    'striped' => false,
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
