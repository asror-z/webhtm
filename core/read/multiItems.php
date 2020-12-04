<?php

/**
 *
 * @author Jakhongir Kudratov
 */

use unclead\multipleinput\renderers\DivRenderer;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetJahongir;
use zetsoft\widgets\inputes\ZKSelect2WidgetRav;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidgetRavshan;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\place\PlaceCountry;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Подобрать товары для переноса даты доставки';
$action->icon = 'fal fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
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
?>

<div id="page">

    <div id="content" class="content-footer p-3">

        <?

        $value = $this->httpGet('value');
        
        $modelClassName = $this->httpGet('modelClassName');
        $modelClass = $this->bootFull($modelClassName);
       
        $model = new $modelClass();

        $model->configs->query = $modelClass::find()
            ->where([
                'id' => $value
            ]);

        $model->configs->readonly = true;
        if ($this->userRole() === 'dev'){
            $model->configs->readonly = false;
        }
        //end
        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'relations' => false,
                'relateMulti' => false,
                'actionButtons' => false,
                'hasItems' => false,
                'columnBefore' => [
                    'checkbox',
                ],
                'columnAfter' => false,
            ]
        ]);

        ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
