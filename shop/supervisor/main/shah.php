<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZDynaSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetX;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fa fa-pie-chart';
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
echo ZMmenuWidget::widget([
    'config' => [
        'isAll' => false,
        'theme' => 'white',
        'content.img.width' => 230,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'all.border' => ZMmenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>
<div id="page">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();


    $model = new ShopOrder();

    $users = [];
    $operators = Az::$app->market->operator->getUserByRole('agent');

    $firstSelect = null;
    if (!empty($operators)) {
        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator)
            $users[$operator['id']] = $operator['title'];

    } else {
        echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
    }

    ?>
    <div class="row">
        <div class="col-md-4 mt-n1">
            <?php
            $startRange = $this->sessionGet('supervisorRangeDatePeriod2');

            if ($this->httpPost('CallsSortForm')) {
                $this->sessionSet('supervisorRangeDatePeriod2', $this->httpPost('CallsSortForm'));
                $this->urlRedirect([$this->actionId]);
            }

            if ($startRange) {
                $beginDate = $startRange['start'][0];
                $endDate = $startRange['start'][1];
                //vdd($beginDate);
                $beginDate = strtotime($beginDate);
                $endDate = strtotime($endDate);

                $beginDate = date('d/m/Y H:i:s', $beginDate);
                $endDate = date('d/m/Y H:i:s', $endDate);


                if ($beginDate && $endDate) {
                    $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
                }
                if (ZArrayHelper::keyExists('status', $startRange)) {
                    $model->configs->query = $model->configs->query->andWhere(['status_callcenter' => $startRange['status']]);
                }
            }

            ?>
        </div>

        <div class="col-md-12">
            <?


            $model->configs->nameOn = [
                'id',
                'contact_name',
                'user_company_ids',
                'contact_phone',
                'status_callcenter',
                'operator',
                'created_at',
                'date_approve',
                'comment_agent',
                'status_callcenter',
                'date_deliver',
                'place_adress_id'
            ];

            $model->configs->pageSize = 30;

            $model->columns();

            ?>

            <div class="col-md-12">
                <?php
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    'rightBtn' => [
                        'export' => [
                            'content' => '{export}{exportExcel}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        //'topRequireUrl' => '/webhtm/shop/supervisor/main/periodPicker.php',
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'sort',
                            'action',
                        ],
                        'columnAfter' => [
                            'false'
                        ],
                        'isCard' => false,
                        'pjax' => false,
                        'contentOptions' => function ($model, $key, $index, $column) {

                            /** @var ShopOrder $model */
                            /** @var User $user */

                            if ($model->user_id == null)
                                return null;

                            $user = \zetsoft\models\user\User::findOne($model->user_id);

                            if ($user == null)
                                return null;

                            $class = ' ';
                            if ($user->purchase_count > 1)
                                $class = 'blue lighten-3';
                            return [
                                'class' => $class
                            ];
                        },

                        'topRequireUrl' => '/webhtm/shop/supervisor/main/top-require-components.php',

                    ],
                    
                ]);

                ?>
            </div>
        </div>
        <style>
            #zdynamicmodel-period {
                display: grid;
                padding-top: 4px;
                border-radius: 4px;
            }
        </style>
    </div>

    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>





    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
