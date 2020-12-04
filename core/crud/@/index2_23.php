<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ButtonItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetAs;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\inputes\ZFloatButtonRightWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */


/** @var Models $model */


$this->beginPage();


$action = new WebItem();


$modelClassName = $this->bootFullUrl();
//   $this->timeBefore('1');

if (class_exists($modelClassName))
    $model = new $modelClassName();
else
    throw new NotFoundHttpException();

$action->title = Azl . $model->configs->title;
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/**
 *
 * Start Page
 */


//vdd(App);

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

if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget()

?>

<div id="page">

    <?
    /*    if (!$this->httpGet('spa'))
            require Root . '/webhtm/block/navbar/admin.php';*/

    /*   echo ZSessionGrowlWidget::widget();

   */
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';

    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?php

                $model->configs->orderCheck = true;
                /*              $model->configs->editClass = ALLData::editClass['sweetAs'];*/
                $model->configs->type = ALLData::type['array'];


                $model->columns();


                echo ZButtonWidget::widget([
                    'config' => [
                        'title' => 'Ссылка',
                        'icon' => 'fas fa-external-link-alt',
                        'pjax' => 1,
                        'url' => '#',
                        'btnRounded' => false,
                        'btn' => true,
                        'hasIcon' => true,
                    ],
                    'active' => [
                        'click' => true,
                        'mousedown' => false,
                        'mouseup' => false,
                        'mouseover' => false,
                        'mousemove' => false,
                        'mouseout' => false,
                        'dragstart' => false,
                    ],
                    'event' => [
                        'click' => <<<JS
    $.pjax.defaults.timeout = false;

   $.pjax.reload({
    container: "#asrorz", 
    async:false,
    // url: url
    });
   console.log('adadad');

JS,

                    ],
                ]);


                $pjax = new ZPjax();
                $pjax->id = 'asrorz';

                $this->pjaxBegin($pjax);

                echo date("Y-m-d H:i:s");


                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'perfectScrollbar' => true,
                        'updateUrl' => '/core/crud/update.aspx?shop_shipment_id={id}',
                    ],
                ]);


                $this->pjaxEnd();


                ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
