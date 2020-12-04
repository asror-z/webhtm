<?php
use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\menu\Menu;
use zetsoft\service\market\Category;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Список Меню';
$action->icon = 'fa fa-chrome';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var ZView $this */
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
#require Root . '/render/menus/ZSidebarWidget/ready/main.php';
#require Root . '/webhtm/block/navbar/main.php';


$action = new Menu();

$action->configs->after = [
    'icon' => [
        [
            'class' => ZKDataColumn::class,
            'label' => Az::l('Редактировать'),
            'format' => 'raw',
            'value' => function ($model, $key, $index, DataColumn $dataColumn) {
                return ZButtonWidget::widget([
                    'id' => 'edit-menu-' . $key,
                    'config' => [
                        'title' => Az::l('Редактировать'),
                        'icon' => 'fas fa-edit',
                        'pjax' => 0,
                        'url' => '/core/menu/editor.aspx?id=' . $key,
                        'btnRounded' => false,
                        'btn' => false,
                        'hasIcon' => true,
                    ],
                    'event' => [
                        'click' => 'function(event){event.preventDefault(); window.open(this.href, "_blank")}',
                    ],
                ]);
            }
        ]
    ]
];

/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $action,
  
]);
$this->endBody() ?>

    </body>
    </html>

<?php $this->endPage() ?>









