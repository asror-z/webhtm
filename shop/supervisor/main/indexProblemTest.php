<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
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

if ($this->httpGet('spa'))
    $action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 *
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
/*$this->timeBefore('time');*/
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

    require Root . '/webhtm/block/header/supervisor.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();$model = new ShopOrder();

    $users = [];
    $operators = Az::$app->market->operator->getUserByRole('agent');

    $firstSelect = null;
    if (!empty($operators)) {
        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator) {
            $users[$operator['id']] = $operator['title'];
        }

    } else {
        echo '<span class="pl-3">' . Az::l("Operators are not found") . '</span>';
    }

    ?>

    <div class="row">
        <div class="col-md-4 mt-n1">
            <?php

            $startRange = $this->sessionGet('supervisorRangeDatePeriod2');

            /*if($startRange && $startRange['start'][0] == ""){

               /* $beginDate = date('d/m/Y H:i:s');
                $endDate = date('d/m/Y H:i:s');

                $startRange['start'][0] = Az::$app->cores->date->dateTime('-24 hours');
                $startRange['start'][1] = Az::$app->cores->date->dateTime();

            }*/


            if ($this->httpPost('CallsSortForm')) {
                $this->sessionSet('supervisorRangeDatePeriod2', $this->httpPost('CallsSortForm'));
                $this->urlRedirect([$this->actionId]);
            }
            if ($startRange) {
                $beginDate = $startRange['start'][0];
                $endDate = $startRange['start'][1];
                $beginDate = strtotime($beginDate);
                $endDate = strtotime($endDate);

                $beginDate = date('d/m/Y H:i:s', $beginDate);
                $endDate = date('d/m/Y H:i:s', $endDate);

                switch (true) {

                    case !empty($beginDate) || !empty($endDate):
                        $model->configs->query = ShopOrder::find()->where([
                            'between', 'created_at', $beginDate, $endDate
                        ]);
                        break;

                    case $startRange['status']:
                        $model->configs->query = ShopOrder::find()->where([
                            'status_callcenter' => $startRange['status']
                        ]);
                        break;

                    case $startRange['status'] && !empty($beginDate) && !empty($endDate):
                        $model->configs->query = ShopOrder::find()->where([
                            'status_callcenter' => $startRange['status']
                        ]);
                        break;

                }

                /* if (!empty($startRange['start']) && !empty($startRange['status'])) {
                     vd('if1');
                     $model->configs->query = ShopOrder::find()->where([
                         'between', 'created_at', $beginDate, $endDate
                     ])->andWhere([
                         'status_callcenter' => $startRange['status']
                     ]);
                 } elseif (ZArrayHelper::keyExists('status', $startRange)) {
                     vd('if2');
                     $model->configs->query = ShopOrder::find()->where([
                         'status_callcenter' => $startRange['status']
                     ]);
                 } elseif (!empty($startRange['start'][0] && $startRange['start'][1])) {
                     vd('if3');
                     $model->configs->query = $model->configs->query = ShopOrder::find()->where([
                         'between', 'created_at', $beginDate, $endDate
                     ]);
                 }*/
            }
            ?>

        </div>

        <div class="col-md-12">
            <?
            $model->configs->nameOn = [

                'id',
                'contact_name',
                'user_company_ids',
                'shop_element_ids',
                'contact_phone',
                'status_callcenter',
                'operator',
                'created_at',
                'date_approve',
                'comment_agent',
                'status_callcenter',
                'date_deliver',
                'status_logistics',
                'place_adress_id',

            ];


            $model->configs->readonly = [
                'status_logistics' => true,
            ];


            $this->paramSet('systemColumns', true);

            $model->configs->titles = [
                'created_at' => Az::L('Поступления')
            ];

            $model->configs->autoSave = false;

            $model->columns();

            ?>

            <div class="col-md-12">
                <?php

                echo ZDynaWidget::widget([

                    'model' => $model,

                    'rightNameEx' => [
                        'system'
                    ],

                    'config' => [
                        'columnBefore' => [
                            'serial',
                            'checkbox',
                            'sort',
                        ],

                        'columnAfter' => [
                            'action'
                        ],

                        'spaArray' => [
                            'create' => true,
                            'update' => false,
                            'detail' => true
                        ],

                        //'updateUrl' => '/shop/supervisor/main/process.aspx?shop_order_id={id}',
                        //'viewUrl' => '/shop/supervisor/main/view.aspx?id={id}',
                        //'createUrl' => '/shop/supervisor/main/create.aspx?id={id}',

                        /*        'search' => true,*/

                        /*'isCard' => false,*/

                        ///  'pjax' => false,

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

    <?php require Root . '\webhtm\block\footer\footerAdmin.php';

    $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
