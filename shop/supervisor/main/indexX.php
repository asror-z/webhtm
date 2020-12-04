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
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
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
        'isAll' => true,
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

    $startRange = $this->sessionGet('supervisorRangeDatePeriod');

    $form = $this->ajaxBegin();
    $app = new ALLApp();

    $column = new Form();
    $column->dbType = dbTypeDate;
    $column->widget = ZHHiddenInputWidget::class;
    $app->columns['start'] = $column;

    $column = new Form();
    $column->dbType = dbTypeDate;
    $column->widget = ZHHiddenInputWidget::class;
    $app->columns['end'] = $column;

    $column = new Form();
    $column->title = 'form_id';
    $column->widget = ZPeriodPickerCallWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
        ],
        'value' => $startRange,
    ];


    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);

    $post = $this->httpPost('ZDynamicModel');


    $period = ZArrayHelper::getValue($post, 'period');
    if ($period && $post !== null) {
        $dateBegin = $period[0];
        $dateEnd = $period[1];

        $this->sessionSet('supervisorRangeDatePeriod', $period);
        $this->urlRedirect(['/supervisor/main/indexX'], true);

    }

    if ($startRange) {
        $beginDate = $this->sessionGet('supervisorRangeDatePeriod')[0];
        $endDate = $this->sessionGet('supervisorRangeDatePeriod')[1];


        if ($beginDate && $endDate) {
            $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
        }
    }
    $model->columns();


    ?>
    <div class="row">
        <div class="col-md-4 mt-n1">
            <?php


            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Филтровать'),
                    'btnType' => ZButtonWidget::btnType['submit'],
                    'btnRounded' => false,
                    'btnStyle' => 'text-success',
                    'btnSize' => 'btn-ml',
                    'class' => 'p-1 pl-3 pr-3'
                ]
            ]);
            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Очистить филтр'),
                    'btnType' => ZButtonWidget::btnType['button'],
                    'btnRounded' => false,
                    'btnStyle' => 'text-info',
                    'btnSize' => 'btn-ml',
                    'class' => 'p-1 pl-3 pr-3',

                ],
                'event' => [
                    'click' => <<<JS
                                    function() {
    
                                            $.ajax({
                                                type: 'POST',
                                                url: '/core/product/rangeClear.aspx',
       
                                                success: function (response) {
                                                    location.reload();
                                                },
                                            });
                                        
                                    }
    JS
                ]
            ]);
            echo ZFormWidget::widget([
                'model' => $model_d,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ],
            ]);
            $this->ajaxEnd();
            ?>
        </div>
        <div class="col-md-4 mt-2 d-flex justify-content-around ">
            <?php
            echo ZDynaCheckWidget::widget([

                'config' => [
                    'inputAttr' => 'operator',
                    'attr' => 'status_callcenter',
                    'value' => 'ring',
                    //'class' => 'simple-Report',
                    'url' => ZUrl::to([
                        '/api/core/app/check-new',
                        'modelClassName' => $model->className,
                    ]),
                    'widgetClass' => ZDropDownListWidget::class,
                    'widgetOptions' => [
                        'data' => $users,
                        'id' => 'operator-dropdown',
                        'config' => [
                            'class' => 'form-control d-block'
                        ],
                    ],

                    'modelClassName' => $model->className,
                    'btnOptions' => [
                        'config' => [
                            'text' => Az::l('На исполнения'),
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnRounded' => false,
                            'btnStyle' => 'text-info',
                            'btnSize' => 'btn-ml',
                            'class' => 'p-1 pl-3 pr-3'
                        ]
                    ]
                ]
            ]);
            echo '<div class="col-3">' . ZCheckDependWidget::widget([

                    'config' => [
                        'attr' => 'status_callcenter',
                        'value' => 'autodial',
                        'dependId' => 'operator-dropdown',
                        'dependAttr' => 'operator',
                        'url' => ZUrl::to([
                            '/api/core/app/check-new',
                            'modelClassName' => $model->className,
                        ]),
                        'widgetClass' => ZDropDownListWidget::class,
                        'widgetOptions' => [
                            'data' => $users,
                            'config' => [
                                'class' => 'form-control w-25'
                            ],
                        ],

                        'modelClassName' => $model->className,
                        'btnOptions' => [
                            'config' => [
                                'text' => Az::l('Автообзвон'),
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnRounded' => false,
                                'btnStyle' => 'text-success',
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 pl-3 pr-3'
                            ]
                        ]
                    ]
                ]) . '</div>';
            ?>
        </div>
        <div class="col-md-12 col-12">
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

            $model->columns();


            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'isCard' => false,
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

                ],
            ]);

            ?>
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


</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
