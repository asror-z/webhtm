<?php

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\drag\DragFormDb;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopOrder;
use zetsoft\widgets\phone\ZSipml5Widget44;
use zetsoft\widgets\phone\ZSipml5WidgetX;


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

?>

<div id="page">

    <?

    //require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div id="rootModal"></div>



        <div class="row">


            <!--DynaWidget begin-->
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-12 col-12">

                        <?

                        $model = new ShopOrder();

                        $model->configs->nameOff = [
                            'contact_phone',
                            'date_deliver'

                        ];

                        $model->configs->after = [
                            'contact_name' => [
                                [
                                    'class' => ZKDataColumn::class,
                                    'label' => Az::l('Контактное имя'),
                                    'width' => '50px',
                                    'value' => function ($model, $key, $index, DataColumn $dataColumn) {


                                        $clickedNumber = $model->contact_phone;

                                        $code = 'function (event)
                                        {
                                           e.preventDefault(); 
                                           var phoneNumber = document.getElementById("txtPhoneNumber").value = "309";
                                           sipCall("call-audio");
                                            
                                        console.log(phoneNumber) 
                                        
                                        }';


                                        //$code = 'function (event){e.preventDefault(); console.log("HELLO") }';
                                        //$code = 'function (event){e.preventDefault(); console.log("{number}") }';
                                        $code = strtr($code, [
                                            '{number}' => $clickedNumber,
                                        ]);

                                        //vdd($clickedNumber);
                                        return ZButtonWidget::widget([

                                            'id' => 'settings-widget-' . $key,
                                            'config' => [
                                                'title' => Az::l('Звонить'),
                                                'icon' => 'fa fa-phone fa-2x fa-inverse',
                                                'pjax' => 0,
                                                'btnSize' => ZColor::btnSize['btn-sm'],
                                                'btnRounded' => true,
                                                'btn' => true,
                                                'hasIcon' => true,
                                                'color' => ZColor::color['green'],

                                            ],
                                            'event' => [
                                                'click' => $code,
                                            ]
                                        ]);
                                    }
                                ],
                            ]
                        ];

                        //$this->require(Root );

                        $model->columns();


                        /** @var ZView $this */
                        echo ZDynaWidget::widget([
                            'model' => $model,
                            'config' => [
                                'hasToolbar' => false,
                                'actionButtons' => ['false'],
                                'columnBefore' => ['false'],
                                'columnAfter' => ['false'],

                                'paginationOptions' => [

                                    'defaultPageSize' => 5,

                                ],
                            ]
                        ]);

                        ?>

                    </div>
                </div>

            </div>


            <!--SIPML5 begin-->

            <div class="col-md-2">

                <?

                /*echo ZSipml5WidgetX::widget([


                ]);*/

                echo $this->require( '/render/phone/ZSipml5Widget/clean/clean1.php');

                ?>
            </div>

        </div>

    </div>

</div>

<style>
    .main_block .block_item:last-child {
        width: 100%;
    }

    .main_block .or2 {
        padding-top: 0;
    }

    .main_block .block_item:first-child {
        height: auto;
    }
</style>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
