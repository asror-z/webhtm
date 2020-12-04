<?php

/**
 *
 * @author OtabekNosirov
 * @author JaloliddinovSalohiddin
 * @author AkromovAzizjon
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Универсальный отчёт';
$action->icon = 'fal fa-calendar-times-o';
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
require Root . '/webhtm/block/navbar/admin.php';
echo ZNProgressWidget::widget([]);
echo ZMMenuWidget::widget([
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
    <div class="row">
        <div class="col-md-12  d-flex justify-content-end mt-4">
            <div class="w-25">
                <?

                echo ZKSelect2Widget::widget([
                    'data' => [
                        'income' => Az::l('Расчёт прибыли'),
                       // 'pay-backs' => Az::l('Выкупы для Колл-Центр'),
                        'portion-order' => Az::l('Проверка порции заказов'),
                       // 'operators' => Az::l('Отчет по операторам'),
                        'accept-courier' => Az::l('Приёмка от курьера'),
                        'courier-report' => Az::l('Отчёт по курьерам'),
                        'skd-dailyreport' => Az::l('СКД Ежедневный отчёт'),
                        'order-report' => Az::l('Заказ переданные курьеру'),
                        'daily-report' => Az::l('Ежедневный отчёт'),
                        'catalog-ware' => Az::l('Отчёт по остаткам товаров в складе'),
                        'company-order' => Az::l('Отчёт по остаткам товаров в магазине'),
                    ],
                    
                    'name' => 'reproting',
                    'id' => 'reproting',
                    'value' => 'income',
                    'event' => [
                        'select' => <<<JS
                        function (event) {
                            $.ajax({
                            
                    url: '/core/report/getReport.aspx',                              
                    method: 'GET',
                    data: {
                        'report': e.target.value,
                    },
                    success: function (data) {
                        //$('#reports').html(data)
                      
                         $('#report').attr('src',data);
                    },
                    error: function (e) {
                        console.log(e)
                    }
                })
                        }
JS,

                    ]
                ]);
                ?>
            </div>
        </div>
        
        <iframe src="/shop/admin/universal-report/income.aspx" id="report" frameborder="0" width="100%" height="100vh" style="min-height: 100vh!important;"></iframe>
    </div>

</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
