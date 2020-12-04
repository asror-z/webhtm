<?php

use PHPUnit\Util\Log\JSON;
use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderCopy;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */


/** @var Models $model */

$modelClassName = $this->bootFullUrl();
$this->beginPage();

//   $this->timeBefore('1');
if (class_exists($modelClassName))
    $model = new $modelClassName();
else
    throw new NotFoundHttpException();


$action = new WebItem();

$action->title = Azl . $model->configs->title;
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;

$action->debug = true;
if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/**
 *
 * Start Page
 */


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

                <?

                $model->configs->orderCheck = true;
  /*              $model->configs->editClass = ALLData::editClass['sweetAs'];*/
                $model->configs->type = ALLData::type['array'];


                $model->columns();
                //Az::$app->market->wares->addInfo(1841);



                echo ZDynaWidgetRav::widget([
                    'model' => $model,
                    /*'config' => [
                        'columnBefore' => [
                            'id',
                            'checkbox',
                            'serial',
                        ],
                    ]*/
                ]);


                //    vdd(get_declared_classes());


                //     file_put_contents('11.txt', $app);

                /** @var ZView $this */

                /*   echo ZDynaWidget::widget([
                       'model' => $model,
                       'config' => [
                           'perfectScrollbar' => false,
                       ]
                   ]);*/

                ?>

            </div>
        </div>


    </div>
    <!-- --><? /*= $this->require( '/webhtm\block\footer\mplace\footerAll.php') */ ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
