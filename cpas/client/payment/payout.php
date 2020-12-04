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

$action->title = Azl . 'Заказать выплату';
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

echo $this->require( '\webhtm\cpas\blocks\header.php');

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Заказать выплату</h2>
            <div>
                <a href="/cpas/client/statistic.aspx" style="font-size: small">Главная</a>
                <span style="font-size: small">/ Заказать выплату</span>
            </div>
        </div>

        <div class="mt-2">

            <?php

            $user_id = $this->userIdentity()->id;
            $user = \zetsoft\models\user\User::findOne($user_id);
            $rekvisits = PaysWithdraw::find()
                ->where([
                    'user_id' => $user_id
                ])->all();
            if($user->balance || !empty($rekvisits))
            {

            $add = $user->balance ? '{add}':'';
            $payment = PaysPayment::find()->where(['user_id' => $user_id])->one();
            $model = new \zetsoft\models\pays\PaysWithdraw();

                $model->configs->query = PaysWithdraw::find()
                    ->where([
                        'user_id' => $user_id
                    ]);

            $model->configs->nameOn = [
                'pays_payment_id',
                'amount',
                'status'
            ];
            $model->configs->readonly = true;

            $model->columns();
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
                        'content' => $add,
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
                    'updateUrl' => '/cpas/client/payment/paymentUpdate.aspx',
                    'createUrl' => '{fullUrl}/createPayout.aspx',
                    'columnBefore' => [
                        'social'
                    ],
                    'paginationOptions' => [
                        'defaultPageSize' => 5,
                    ],
                    'columnAfter'=> false,
                    'titleSummary' => false,
                    'isCard' => false,
                    'summary' => true
                ],

            ]);

            }
            else{

            echo Az::l('К сожалению, на вашем балансе нет средств');

            }

            ?>


        </div>
    </div>
</div>


        <? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>
        <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
