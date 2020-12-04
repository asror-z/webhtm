<?php

use yii\data\Sort;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\sorter\ZLinkSorterWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

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
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';

?>

<div class="container-fluid mt-2" >


    <div class="col-md-12 p-0">


        <?php

        $this->pjaxBegin();
        echo ZLinkSorterWidget::widget([
            'sort' => new Sort([
                'attributes' => [
                    'name' => [
                        'label' => 'Po imya'
                    ],
                    'price' => [
                        'label' => 'Po tsena'
                    ],
                ]
            ])
        ]);
        echo ZInfinityScrollAjaxWidget::widget([
            'config' => [
                'url' => 'infinity.aspx',
                'requireUrl' => '/render/cards/ZListViewWidget/demo/vertical.php',
                'limit' => 4,
                'namespace'=>'market',
                'service'=>'product',
                'method'=>'allProducts',
                'args'=>null
                //'cols' => 2
            ]
        ]);

        $this->pjaxEnd();

        ?>
    </div>
    

</div>

<?php
echo ZFooterAllWidget::widget();
//echo ZJspanelWidget::widget();
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
