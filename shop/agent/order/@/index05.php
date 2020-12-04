<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaCheckWidget;
use zetsoft\widgets\former\ZCheckSelectWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetJ;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
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

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?
                ZCardWidget::begin([
                    'config' => [
                        'type' => ZCardWidget::type['dynCard'],
                        'classHeadColor' => 'bg-primary',
                        'hasIcon' => true,

                    ]
                ]);
                $model = new ShopOrder();

               

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


                 $check = "<div class='col-md-8'>" . ZDynaCheckWidget::widget([

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


                 $button = "<div class='col-md-3'>" . ZCheckDependWidget::widget([

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
                                 'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
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
                        /*'topRequireUrl'=>'/webhtm/shop/agent/order/dynaTopRequire.php',*/
                    ],
                    'leftBtn' => [
                        'search' => [
                            'content' => $check . $button,
                            'options' => [
                                'class' => 'd-flex justify-content-around px-3 col-dm-12'
                            ]
                        ],
                       
                    ]
                ]);

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
