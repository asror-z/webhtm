<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasPaymentForm;
use zetsoft\models\cpas\CpasFinance;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;
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


require Root . '/webhtm/block/navbar/mainArbit.php';;

echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="my-2 p-2 px-3 shadow-sm p-3 bg-white">
        <h2 class="text-muted">Заказать выплату</h2>
        <div>
            <a href="/cpas/admin/offer.aspx">Главная</a>
            <span href="/cpas/admin/payouts.aspx"> / Финансы </span>
            <span href="/cpas/admin/payouts.aspx"> / Заказать выплату</span>
        </div>
    </div>

    <div class="container-fluid grey lighten-4">


        <?
        $form = $this->ajaxBegin();

        $model = new CpasPaymentForm();

        $model->cards = [
            [
                'title' => Az::l('Создание Бренды'),
                'shows' => true,
                'items' => [
                    [
                        'title' => Az::l('Форма'),
                        'shows' => true,
                        'items' => [

                            [
                                'currency',
                                'cash',
                                'amount',
                                'total_amount',
                            ],
                            [

                            ]

                        ],
                    ],
                ],
            ],
        ];
        $model->columns();

        echo ZFormBuildWidget::widget([

            'model' => $model,
            'form' => $form,

            'config' => [
                'stepType' => ZFormBuildWidget::stepType['none'],

                'blockType' => ZFormBuildWidget::blockType['card'],

                'stepOptions' => [],

                'blockOptions' => [
                    'config' => [
                        'headerColor' => ZColor::color['green-special'],
                        'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                    ]
                ],

                'isStepsVertical' => false,
                'topBtn' => false,
                'botBtn' => true,
                'btnTitle' => null,
                'isCard' => true,
                'btnClass' => '',
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-default'],
            ]
        ]);

        $url = ZUrl::to([
            '/cpas/admin/offer',
        ]);

        $this->ajaxEnd();
        if ($this->httpPost('CpasPaymentForm')) {
            return $this->urlRedirect($url);

        }

        ?>

        <?

        $user_id =  $this->userIdentity()->id;
        $cpaFinance = new CpasFinance();
        $cpaFinance->query = CpasFinance::find()->where([
            'user_id' => $user_id
        ]);

       echo ZCardWidget::begin([
            'config' => [
                'title' => $title,
                'type' => ZCardWidget::type['dynCard'],
                'classHeadColor' => 'bg-white text-dark',
                'headerRight' => $btn,
                'footerText' => $footer,
                'hasFooter' => true,
                'footerColor' => ZColor::color['green-special'] . ' text-black',
            ]
        ]);


        echo ZDynaWidget::widget([
        
            'model' => $country,

            'config' => [
                'showFooter' => false,
                'titleSummary' => true,
                'isCard' => false,
                'columnBefore' => false,
                'columnAfter' => false,
                'hasToolbar' => false,
                'search' => false,
                'heighbody' => '100%',
                'filter' => false,
                'summary' => true,
                'perfectScrollbar' => false,
                'striped' => false,
                'hasWidth' => false,
                'panelTemplate' => "{items}",
            ]
            
        ]);


         ZCardWidget::end();
        ?>


    </div>


    <style>

        .kv-grid-table thead {
            display: none;
        }

    </style>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
