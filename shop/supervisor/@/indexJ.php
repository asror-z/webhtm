<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\pays\PaysCurrency;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidget1;
use zetsoft\widgets\former\ZDynaWidgetJ;
use zetsoft\widgets\former\ZDynaWidgetRav;
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
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
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
        'all.border' => ZMMenuWidget::border['border-full'],
        'menu-effect-slide' => true,
    ],
]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/navbar/admin.php';
    //require Root . '/webhtm/block/navbar/mainAdmin.php';
    //require Root . '/webhtm/block/menu/menu-m.php';

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




    $model->configs->nameShowEx = $nameHide = [

        'modified_at',
        'created_by',
        'modified_by',
        'deleted_by',
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
            <div class="col-md-3 mt-n2">
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

            <div class="col-md-4">
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
                if (!empty($operators)) {
                    echo ZButtonWidget::widget([
                        'id' => 'ring',
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],

                            'text' => Az::l('На исполнения'),
                            'btnRounded' => false,
                            'btnSize' => 'btn-ml',
                            'btnStyle' => 'text-success border border-success',
                            'name' => 'submitOrder',
                            'class' => 'p-0 mt-4 pl-3 pr-3'
                        ],

                    ]);
                    echo ZButtonWidget::widget([
                        'id' => 'autodial',
                        'config' => [
                            'btnType' => ZButtonWidget::btnType['button'],
                            'text' => Az::l('Автообзвон'),
                            'btnRounded' => false,
                            'btnSize' => 'btn-ml',
                            'btnStyle' => 'text-info border border-info',
                            'name' => 'submitOrder',
                            'class' => 'p-0 mt-4 pl-3 pr-3'
                        ],

                    ]);
                }
                ?>
            </div>

            <div class="col-md-12 col-12">

                <?
                 

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                ]);

                ?>

            </div>
        </div>
    </div>


</div>
<style>
    #zdynamicmodel-period{
        display:grid;
        padding-top: 4px;
        border-radius:2px;
    }
  

</style>


<?

require(Root . '/webhtm/block\footer\mplace\footerAll.php')

?>


</body<?php $this->endBody() ?>
<script>
    jQuery.fn.extend({
        attrs: function (attributeName) {
            var results = [];
            $.each(this, function (i, item) {
                results.push(item.getAttribute(attributeName));
            });
            return results;
        }
    });
    $('#ring').on("click", function (e) {

        var dynaCheckObj = $(".table-danger").attrs("data-key");
        var dynaCheckJSON = JSON.stringify(dynaCheckObj);
        var agent = $(".select2-selection__rendered").attr("title");

        $.ajax({
            url: '/core/product/setOrderToAgent.aspx',
            type: 'GET',
            data: {
                status: 'ring',
                agent: agentId,
                checkList: dynaCheckJSON,
            }, success: function (data) {

                console.log(data);
                location.reload();
            },

        });

    });

    $('#autodial').on("click", function (e) {

        var dynaCheckObj = $(".table-danger").attrs("data-key");
        var dynaCheckJSON = JSON.stringify(dynaCheckObj);
        var agent = $(".select2-selection__rendered").attr("title");

        $.ajax({
            url: '/core/product/setOrderToAgent.aspx',
            type: 'GET',
            data: {
                status: 'autodial',
                agent: agentId,
                checkList: dynaCheckJSON,
            }, success: function (data) {

                console.log(data);
                location.reload();
            },

        });

    });
</script>>
</html>

<?php $this->endPage() ?>

