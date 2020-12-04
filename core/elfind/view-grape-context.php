<?php

use rmrevin\yii\fontawesome\FAS;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\elfin\ElfinderContextMenu;
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZElfinderWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-rocket rss';
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

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $data = [];
                $item = new ElfinderItem();
                $item->path = Root . '/webhtm/shop';
                $item->url = '/webhtm/shop';
                $data[] = $item;

                $item = new ElfinderItem();
                $item->path = Root . '/webhtm/ALL';
                $item->url = '/webhtm/ALL';
                $data[] = $item;


                /**
                 * Context
                 */

                $context = [];

                $menu = new ElfinderContextMenu();
                $menu->title = Az::l('Edit in grapes');
                $menu->icon = FAS::_YOAST;
                $menu->name = 'grape';
                $menu->url = '/core/widget/samplewidgetnorm.aspx?path={fileNameNoExt}';
                $context[] = $menu;

                
                $menu = new ElfinderContextMenu();
                $menu->title = Az::l('Open Page');
                $menu->name = 'pageOpen';
                $menu->icon = FAS::_YOAST;
                $menu->url = '/core/tester/asror/main.aspx?path={fileNameNoExt}';

                $context[] = $menu;


                echo ZElfinderWidget::widget([
                    'config' => [
                        'context' => $context,
                        'type' => [
                            'text/x-php',
                            'text/html',
                            'directory',
                        ],
                        'handler' => '/core/tester/asror/main.aspx?path=render/{fileNameNoExt}'
                    ],
                    'data' => $data
                ]);

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
