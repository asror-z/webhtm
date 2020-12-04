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
                use zetsoft\models\page\PageAction;
                use zetsoft\system\Az;
                use zetsoft\system\helpers\ZArrayHelper;
                use zetsoft\widgets\former\ZGrapesJsWidget;
                use zetsoft\widgets\former\ZGrapesJsWidgetExample;
                use zetsoft\widgets\former\ZGrapesJsWidgetOtabek;
                use zetsoft\widgets\former\ZGrapesJsWidgetRav;
                use zetsoft\widgets\former\ZGrapesJsWidgetRavshanNorm;
                use zetsoft\widgets\notifier\ZSweetAlert2Widget;

                /** @var ZView $this */
                $action->debug = true;

                $this->grape=true;

                Az::$app->controller->layout = 'grapes';
                

                $actionId = $this->httpGet('key');
                $PageAction = PageAction::findOne($actionId);

                $name = 'core/kernel/widget/class';

                if ($PageAction)
                    $name = $PageAction->name;

                $path = Root . '/webhtm/' . $name . '.php';
                $path = str_replace('\\', '/', $path);

                $assets = $this->viewAsset($path);
                $pregs = Az::$app->utility->pregs;

                $scripts = ZArrayHelper::getValue($pregs->pregMatchAll($assets, '<script src="(.*?)".*?>'), 1);
                $links = ZArrayHelper::getValue($pregs->pregMatchAll($assets, '<link href="(.*?)".*?>'), 1);

                Az::$app->params['grape'] = true;
                $page = $this->requireAjaxFilePreg($path);

                ZGrapesJsWidgetRav::begin([
                    'config' => [
                        'scripts' => $scripts,
                        'styles' => $links,
                        'categories' => [
                            'former',
                            'inputes',
                            'columns'
                        ],
                        'saveFile' => $path
                    ]
                ]);

                echo $page;

                ZGrapesJsWidgetRav::end();?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
