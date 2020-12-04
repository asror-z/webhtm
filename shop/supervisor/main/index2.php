<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\values\ZDateFormatWidget;


/** @var ZView $this */

/**
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->layout = true;
$action->layoutFile = 'test';

$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();


?>

<div id="page">

    <?php

    global $boot;

    vd($boot->isProd());

    $model = new ShopOrder();

    $model->configs->valueWidget = [
        'date_deliver' => ZDateFormatWidget::class,
        'date_approve' => ZDateFormatWidget::class,
    ];

    $model->configs->valueOptions = [
        'date_deliver' => [
            'config' => [
                'hour' => true,
            ]
        ]
    ];

    $users = [];

    $operators = Az::$app->market->operator->getUserByRole('agent');


    $firstSelect = null;

    if (!empty($operators)) {

        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator) {
            $users[$operator['id']] = $operator['title'];
        }

    }

    /* else {
         echo '<span class="pl-3">' . Az::l("Operators are not found") . '</span>';
     }*/

    ?>

    <div class="row">
        <div class="col-md-4 mt-n1">
            <?php
            $startRange = $this->sessionGet('supervisorRangeDatePeriod2');


            /*
             if($startRange && $startRange['start'][0] == ""){

               /* $beginDate = date('d/m/Y H:i:s');
                $endDate = date('d/m/Y H:i:s');

                $startRange['start'][0] = Az::$app->cores->date->dateTime('-24 hours');
                $startRange['start'][1] = Az::$app->cores->date->dateTime();

            }

            */


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
                        ])->orderBy([
                            'id' => SORT_DESC
                        ]);
                        break;

                    case $startRange['status']:
                        $model->configs->query = ShopOrder::find()->where([
                            'status_callcenter' => $startRange['status']
                        ])->orderBy([
                            'id' => SORT_DESC
                        ]);
                        break;

                    case $startRange['status'] && !empty($beginDate) && !empty($endDate):
                        $model->configs->query = ShopOrder::find()->where([
                            'status_callcenter' => $startRange['status']
                        ])->orderBy([
                            'id' => SORT_DESC
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
                'time_deliver',
                'comment_agent',
                'status_callcenter',
                'date_deliver',
                'status_logistics',
                'place_adress_id',
            ];

            /* $model->configs->after = [
                 'user_company_ids' => [
                     [
                         'class' => ZKDataColumn::class,
                         'label' => 'Отчеты',
                         'value' => function (ShopOrder $model, $key, $index, DataColumn $dataColumn) {
                               $items = ShopOrderItem::find()
                                 ->where([
                                     'shop_order_id' => $model->id
                                 ])
                                 ->select('name')
                                 ->asArray()
                                 ->all();

                               $names = ZArrayHelper::map($items, 'name', 'name');
                               return implode(', ', $names);
                         }
                     ],


                 ]
             ];*/


            $model->configs->pageSize = 30;

            $model->configs->readonly = [
                'status_logistics',
                'created_at',
                'date_approve',
            ];

            $model->configs->filter = [
                'created_at' => false
            ];

            $model->configs->filterOptions = [
                'user_company_ids' => [
                    'config' => [
                        'multiple' => false
                    ]
                ],

            ];

            $this->paramSet('systemColumns', true);

            $model->configs->titles = [
                'created_at' => Az::L('Поступления')
            ];

            $model->configs->changeSave = true;

            $model->columns();

            ?>

            <div class="col-md-12">

                <?php

             //   $this->pjaxBegin();

                echo ZDynaWidget::widget([

                    'model' => $model,

                    'rightNameEx' => [
                        'system',
                    ],
                    'rightBtn' => [
                        'add-clone-delete' => [
                            'content' => '{add}{tabular}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        'export' => [
                            'content' => '{jsonExcel}',/*{export}{exportAll}{excelBosya}*/
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],

                    'config' => [

                        'relations' => false,
                        'relateMulti' => false,
                        'hasItems' => false,

                        'actionButtons' => [
                            'update',
                            'view',
                                /*'clone',*/
                            'delete',
                        ],

                        'columnBefore' => [
                            'checkbox',
                            'serial',
                            'sort',
                        ],

                        'columnAfter' => [
                            'action',
                        ],

                        'spaArray' => [
                            'create' => true,
                            'update' => false,
                            'detail' => true
                        ],

                        'updateUrl' => '/shop/supervisor/main/processUpdate.aspx?shop_order_id={id}&changeSave=1',

                        'viewUrl' => '/shop/supervisor/main/view.aspx?id={id}',

                        'createUrl' => '/shop/supervisor/main/create.aspx?id={id}&changeSave=1',

                        'heighbody' => '100vh',

                        'search' => true,
                        'isCard' => false,

                        'tableOptions' => [
                            'style' => 'font-size: 6px!important;'
                        ],

                        'options' => [
                            'style' => 'font-size: 6px!important;'
                        ],

                        'contentOptions' => static function ($model, $key, $index, $column) {

                            $class = ' ';

                            /** @var ShopOrder $model */

                            /** @var User $user */

                            $contact_name = ZArrayHelper::getValue($model, 'contact_name');
                            $contact_phone = ZArrayHelper::getValue($model, 'contact_phone');
                            $user_id = ZArrayHelper::getValue($model, 'user_id');

                            if ($contact_name === null)
                                return null;

                            if ($user_id !== null) {
                                return [
                                    'style' => 'font-size: 6px!important;'
                                ];
                                $user = \zetsoft\models\user\User::findOne($user_id);
                                if ($user !== null)

                                    if ($user->purchase_count > 1)
                                        $class = 'blue lighten-3';
                            }

                            $count = ShopOrder::find()
                                ->where([
                                    'contact_phone' => $contact_phone
                                ])
                                ->count();

                            if ($count > 1)
                                $class = 'blue lighten-3';

                            return [
                                'class' => $class,
                                'style' => 'font-size: 6px!important;'
                            ];

                        },
                        'topRequireUrl' => '/webhtm/shop/supervisor/main/datepicker-statusX.php',
                    ],
                ]);

            //    $this->pjaxEnd();

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

