<?php

use rmrevin\yii\fontawesome\FAS;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\elfin\ElfinderContextMenu;
use zetsoft\dbitem\elfin\ElfinderItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZFileHelper;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZElfinderWidget;
use zetsoft\widgets\blocks\ZElfinderWidget4;
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
                $attr = [];
                $item = new ElfinderItem();

                $item->path = Root . '/webhtm';
                $item->url = '/webhtm';
                $item->accessControl = 'access';


                // for folder
                $attr['lock'] = $item->lock = true;
                $attr['write'] = $item->write = false;
                $attr['read'] = $item->read = false;
                $attr['hidden'] = $item->hidden = false;
                $attr['pattern'] = $item->pattern = "/core|cpas/";
                $item->attributes[] = $attr;
                unset($attr);


                // for file
                $attr['lock'] = $item->lock = true;
                $attr['write'] = $item->write = false;
                $attr['read'] = $item->read = false;
                $attr['hidden'] = $item->hidden = false;
                $attr['pattern'] = $item->pattern = "/acceptcourier.php|income.php|courierreportA.php|courierreport.php|operators.php|orderStatus.php|pay-backs.php|portionorder.php|rejectcauses.php|skd-dailyreport.php|universalReport.php/";

                $item->attributes[] = $attr;
                
                unset($attr);

                $attr['lock'] = $item->lock = true;
                $attr['write'] = $item->write = false;
                $attr['read'] = $item->read = false;
                $attr['hidden'] = $item->hidden = true;

                //$attr['pattern'] = $item->pattern  =  "/^acceptcourier_able.php|acceptcourier_OtherApp|acceptcourier_eyuf.*$/";

                $path = Root . '/webhtm/shop/admin/reports/App/';


                /**
                 *  show files list
                 */


                $arrayEx = [
                    'acceptcourier_eyuf.php',
                    'income_eyuf.php',
                    'courierreportA_eyuf.php',
                    'courierreport_eyuf.php',
                    'operators_eyuf.php',
                    'orderStatus_eyuf.php',
                    'pay-backs_eyuf.php',
                    'portionorder_eyuf.php',
                    'rejectcauses_eyuf.php',
                    'skd-dailyreport_eyuf.php',
                    'universalReport_eyuf.php',
                ];

                $filteredFiles = Az::$app->filemanager->elfinderTools->filterPath($path, $arrayEx);

                $attr['pattern'] = $item->pattern = "/$filteredFiles/";

                $item->attributes[] = $attr;
                
                unset($attr);
                //webhtm\shop\admin\reports\App\.php

                $data[] = $item;


                /**
                 * Context
                 */

                $context = [];

                $menu = new ElfinderContextMenu();

                $menu->title = Az::l('Edit in grapes');

                $menu->icon = FAS::_YOAST;

                $menu->name = 'grape';

                $menu->iconUrl = "https://img.icons8.com/ios-glyphs/60/000000/cinema---v2.png";

                $menu->url = '/core/widget/samplewidgetnorm.aspx?path={fileNameNoExt}';

                $context[] = $menu;


                $menu = new ElfinderContextMenu();

                $menu->title = Az::l('Open Page');

                $menu->name = 'pageOpen';

                $menu->iconUrl = "https://img.icons8.com/ios-glyphs/60/000000/cinema---v2.png";

                $menu->icon = FAS::_YOAST;

                $menu->url = '/core/tester/asror/main.aspx?path={fileNameNoExt}.apx';

                $context[] = $menu;

                echo ZElfinderWidget::widget([

                    'config' => [
                    
                        'context' => $context,

                        'type' => [
                            'text/x-php',
                            'text/html',
                            'directory',
                        ],

                        'mode' => ZElfinderWidget::mode['edit'],

                        'handler' => '/core/tester/asror/main.aspx?path=render/{fileNameNoExt}'

                    ],
                    'data' => $data,
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
