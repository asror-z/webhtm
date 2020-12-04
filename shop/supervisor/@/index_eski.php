<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\pays\PaysCurrency;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonGetWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\inputes\ZDropDownListWidget;
use zetsoft\widgets\former\ZCheckDependWidget;
/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-money-check-edit-alt';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        //'data' => $this->cores->menus->create('mmenu'),
        'config' => [
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
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();$model = new ShopOrder();

    $startRange = $this->sessionGet('rangeDatePeriod');

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
    $column->widget = ZPeriodPickerWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
        ],
        'value' =>$startRange,
    ];



    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);




    $model->configs->nameOn = [
        "id",
        "contact_name",
        "user_company_ids",
        "contact_phone",
        "status_callcenter",
        "operator",
        "created_at",
        "date_approve",
        "comment_agent",
        "status_callcenter",
        "date_deliver",
        "place_adress_id"
    ];


    $post = $this->httpPost('ZDynamicModel');


    $period= ZArrayHelper::getValue($post, 'period');
    if ($post !== null) {
        $dateBegin = $period[0];
        $dateEnd = $period[1];

        $this->sessionSet('rangeDatePeriod',$period);
        $this->urlRedirect(['/supervisor/main/index'],true);

    }

    if($startRange) {
        $beginDate = $this->sessionGet('rangeDatePeriod')[0];
        $endDate = $this->sessionGet('rangeDatePeriod')[1];


        if ($beginDate && $endDate) {
            $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
        }
    }
    $model->columns();

     ?>


    <?




    $users = [];
    $operators = Az::$app->market->operator->getUserByRole('agent');

    $firstSelect = null;
    if (!empty($operators)) {
        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator)
            $users[$operator['id']] = $operator['name'];

    } else {
        echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
    }

    ?>

    <div id="content" class="content-footer p-3">

        <script>
            var agentId = <?=$firstSelect?>;
        </script>


        <div class="row">
            <div class="col-md-4 mt-n2">
                <?php

                echo ZFormWidget::widget([
                    'model' => $model_d,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],


                ]);
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Филтровать'),
                        'btnType' => ZButtonWidget::btnType['submit'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-success border border-success',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-0 pl-3 pr-3'
                    ]
                ]);
                echo ZButtonWidget::widget([
                    'config' => [
                        'text' => Az::l('Очистить филтр'),
                        'btnType' => ZButtonWidget::btnType['button'],
                        'btnRounded' => false,
                        'btnStyle' => 'text-info border border-info',
                        'btnSize' => 'btn-ml',
                        'class' => 'p-0 pl-3 pr-3',

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
                $this->ajaxEnd();
                ?>
            </div>
            <div class="col-md-6 pt-3">
                <?

                echo ZKSelect2Widget::widget([
                    'data' => $users,
                    'name' => 'selectAgent',
                    'event' => [
                        'select' => <<<JS
                                function() {
                                    window.agentId = $(this).val();
                                }
                            JS,

                    ]
                ]);


                ?>
            </div>
             <div class="col-md-2 pt-4">
                 <?php
                 if (!empty($operators))
                     echo ZButtonWidget::widget([
                         'id' => 'w011',
                         'config' => [
                             'btnType' => 'submit',
                             'text' => Az::l('Отправить'),
                             'btnRounded' => false,
                             'btnSize' => 'btn-md mt-0 pt-1 pb-1 pl-2 pr-2',
                             'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                             'name' => 'submitOrder'
                         ],


                     ]);
                 ?>

             </div>
           

            <div class="col-md-12 col-12">












                <?

                echo "<div class='col-md-8'>" . ZCheckSelectWidget::widget([

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
                                    'text' =>  Az::l('На исполнения'),
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                                    'btnType' => ZButtonWidget::btnType['submit'],
                                    'btnRounded' => false,
                                    'btnSize' => 'btn-ml',
                                    'class' => 'p-1'
                                ]
                            ]
                        ]
                    ]) . "</div>";


                echo "<div class='col-md-3'>" . ZCheckDependWidget::widget([

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
                                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                    'btnType' => ZButtonWidget::btnType['submit'],
                                    'btnRounded' => false,
                                    'btnSize' => 'btn-ml',
                                    'class' => 'p-1 mx-1'
                                ]
                            ]
                        ]
                    ]) . "</div>";
                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'isCard' => false,
                        'contentOptions' => function ($model, $key, $index, $column) {
                            /** @var ShopOrder $model */
                            /** @var User $user */
                            $user = \zetsoft\models\user\User::findOne($model->user_id);
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
        </div>
     <!--   <script>
            jQuery.fn.extend({
                attrs: function (attributeName) {
                    var results = [];
                    $.each(this, function (i, item) {
                        results.push(item.getAttribute(attributeName));
                    });
                    return results;
                }
            });
            $('#w011').on("click", function (e) {

                var dynaCheckObj = $(".table-danger").attrs("data-key");
                var dynaCheckJSON = JSON.stringify(dynaCheckObj);
                var agent = $(".select2-selection__rendered").attr("title");

                $.ajax({
                    url: '/core/product/setOrderToAgent.aspx',
                    type: 'GET',
                    data: {
                        agent: agentId,
                        checkList: dynaCheckJSON,
                    }, success: function (data) {

                        console.log(data);
                        location.reload();
                    },

                });

            });
        </script>-->

    </div>

</div>

<?

require(Root . '/webhtm/block\footer\mplace\footerAll.php')

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

