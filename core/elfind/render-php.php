<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
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

                /** @var ZView $this */
                $data = [];
                $item = new ElfinderItem();
                $item->path = Root . '/render';
                $item->url = '/render';
                $data[] = $item;

                echo ZElfinderWidget::widget([
                    'config' => [
                        'type' => [
                            'text/x-php',
                            'directory',
                        ],
                        'handler' => "/core/tester/asror/main.aspx?path=render/{fileName}",
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
