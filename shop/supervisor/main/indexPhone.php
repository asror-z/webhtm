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
use zetsoft\widgets\phone\ZJsSipWidget;


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

    echo ZSessionGrowlWidget::widget();


    $model = new ShopOrder();

    $users = [];
    $operators = Az::$app->market->operator->getUserByRole('agent');

    $firstSelect = null;
    if (!empty($operators)) {
        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator) {
            $users[$operator['id']] = $operator['title'];
        }

    } else {
        echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
    }

    ?>

    <div class="row">

        <div class="col-md-10">

            <div class="row">
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
                        'place_adress_id'
                    ];
                    $this->paramSet('systemColumns', true);

                    $model->configs->titles = [
                        'created_at' => Az::L('Поступления')
                    ];


                    $model->columns();

                    ?>

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
                            'search' => true,
                            'isCard' => false,
                            'pjax' => false,
                            'contentOptions' => function (ShopOrder $model, $key, $index, $column) {
                                $class = ' ';
                                /** @var ShopOrder $model */
                                /** @var User $user */
                                if ($model->contact_phone === null)
                                    return null;

                                if ($model->user_id !== null) {
                                    return null;
                                    $user = \zetsoft\models\user\User::findOne($model->user_id);
                                    if ($user !== null)



                                        if ($user->purchase_count > 1)
                                            $class = 'blue lighten-3';
                                }
                                $count = ShopOrder::find()
                                    ->where([
                                        'contact_phone' => $model->contact_phone
                                    ])
                                    ->count();
                                if ($count > 1)
                                    $class = 'blue lighten-3';

                                return [
                                    'class' => $class
                                ];
                            },

                            'topRequireUrl' => '/webhtm/shop/supervisor/main/datepicker-statusX1.php',

                        ],
                    ]);

                    ?>
                </div>

            </div>

        </div>


        <div class="col-md-2">

            <?

            $sipml = [];
            $item = new \zetsoft\dbitem\App\eyuf\SIPMLItem();
            $item->impu = '@10.10.3.60:5060';

            /*
                $item->impi = '301';
                $item->password = '301';
            */

            $item->impi = "301";
            $item->password = "301";

            $item->websocket_proxy_url = 'wss://10.10.3.60:8089/ws';
            $item->keypad = true;
            $item->phoneInputDisplay = true;
            $item->orderInputDisplay = false;
            $item->buttonClass = 'enabled';

            $sipml[] = $item;

            echo ZJsSipWidget::widget([
                'data' => $sipml
            ]);

            //echo $this->require( '/render/phone/ZJSSipWidget/local31-sher/cleanX2.php');

            ?>

        </div>

    </div>


    <?php require Root . '\webhtm\block\footer\footerAdmin.php';
    $this->endBody() ?>

    <style>
        #zdynamicmodel-period {
            display: grid;
            padding-top: 4px;
            border-radius: 4px;
        }

        .main_block .block_item:last-child {
            width: 100% !important;
        }
    </style>

</body>
</html>

<?php $this->endPage() ?>
