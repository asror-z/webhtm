<?php

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\CollectionMacroServiceProvider;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZCollect;
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
<div id="app">

    <?

    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();


    ?>


    <?php

    $shop_order_id = $this->httpGet('shop_order_id');

    $shopOrder = ShopOrder::findOne($shop_order_id);

    if ($shopOrder === null)
        $shopOrder = new ShopOrder();


    $shopOrder->configs->nameOn = [
        'contact_name',
        'contact_phone',
        'add_contact_phone',
        'date_deliver',
        'operator',
        'status_callcenter',
    ];

    $shopOrder->cards = [
        [
            'title' => Az::l('Первый этап'),
            'shows' => true,
            'items' => [

                [
                    'title' => Az::l('Форма'),

                    'shows' => true,
                    'items' => [

                        [
                            'contact_name',
                            'contact_phone',

                        ],
                        [
                            'add_contact_phone',
                            'operator',
                        ],
                        [
                            'date_deliver',

                            'status_callcenter'
                        ]

                    ],
                ],

            ],
        ],
    ];

    $shopOrder->configs->rules = [
        'date_deliver' => validatorSafe,
        'contact_name' => validatorSafe
    ];

    $shopOrder->configs->changeSave = true;  //bazaga yozadi

    $shopOrder->configs->hasLabel = true;

    $shopOrder->columns();  //configlarni nastroyka qilib beradi bu yozilishi shart


    if ($this->modelSave($shopOrder)) {
        $this->urlRedirect(['index', true]);
    }

    $active = new Active();

    $active->type = Active::type['vertical'];

    $active->childClass = 'my-3';

    ZCardWidget::begin([
        'config' => [
            'title' => Az::$app->view->title,
            'type' => ZCardWidget::type['dynCard'],
        ]
    ]);

    $form = $this->activeBegin($active);

    echo ZFormBuildWidget::widget([
        'model' => $shopOrder,
        'form' => $form,
        'config' => [
            'btnTitle' => Az::l('Оформить и закрыть'),
            'stepType' => ZFormBuildWidget::stepType['none'],
            'blockType' => ZFormBuildWidget::blockType['naked'],
            'botBtn' => true,
            'topBtn' => true,
            'showCancelBtn' => false
        ]
    ]);

    $this->activeEnd();

    ZCardWidget::end();


    ?>


</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
