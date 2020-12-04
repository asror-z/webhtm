<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZElfinderWidget;
use zetsoft\widgets\blocks\ZElfinderWidget2;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\shop\ShopBrand;


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
              //  vdd(App);

                $data = [];


                $myPath = '/webhtm/shop/' ;
                $item = new ElfinderItem();

                $item->path = Root . $myPath;
                $item->url = $myPath;
                $data[] = $item;


                $myPath = '/webhtm/ALL';

                $item = new ElfinderItem();
                $item->path = Root . $myPath;
                $item->url = $myPath;
                $data[] = $item;

                echo \zetsoft\widgets\blocks\ZElfinderBekzodWidget::widget([
                    'config' => [
                        'type' => [
                            'text/x-php',
                            'text/html',
                            'directory',
                        ],
                        'handler' => "/shop/{fileNameNoExt}.aspx"
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
