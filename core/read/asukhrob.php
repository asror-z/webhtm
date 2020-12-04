<?php

/*
modelClassName
attr
id
*/

/** @var ZView $this */


use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use \zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\models\shop\ShopOrder;

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Salam';
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;



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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();

?>

    <div id="page" class="col-md-12">
        <?
        if (!$this->httpGet('spa'))
            require Root . '/webhtm/block/navbar/admin.php';

        echo ZSessionGrowlWidget::widget();




        $modelClassName = $this->httpGet('modelClassName');
        $attr = $this->httpGet('attr');
        $id = $this->httpGet('id');

        $model = new $modelClassName;

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $model,
        ]);
/*
        echo ZDynaWidget::widget([
            'model' => $model,
            'rightName' => [
                'update',
                'report',
                'add-clone-delete',
            ],
            'config' => [
                'showPageSummary' => true,
                'isNewRecord' => true,

                'newRecordValues' => [

                    'models' => $models

                ],
            ]
        ]);
*/
        ?>
    </div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
