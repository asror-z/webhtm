<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopCourier;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\system\actives\ZActiveRecord;
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

        $this->pjaxBegin();

        //start|DavlatovRavshan|2020.10.10
        $id = $this->httpGet('id');
        $modelClassBase = $this->httpGet('modelClassName');
        $modelClassName = $modelClassBase . 'Item';

        $modelClass = $this->bootFull($modelClassName);
        /** @var ZActiveRecord $model */
        $model = new $modelClass();

        $attr = ZInflector::underscore($modelClassBase);

        $model->configs->query = $modelClass::find()
            ->where([
                $attr . '_id' => $id
            ]);
        //start|DavlatovRavshan|2020.10.10

        //start|MurodovMirbosit|09.10.2020
        /* $model->configs->readonly = true;
         if ($this->userRole() === 'dev') {
             $model->configs->readonly = false;
         }*/
        //end
        
        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'pjax' => false,
                'updateUrl' => '{fullUrl}/process.aspx?shop_order_id={id}',
                'actionButtons' => true,
                'columnBefore' => [
                    'checkbox',
                ],
                'spaArray' => [
                    'update' => false,
                    'create' => true,
                ],
                'spaHeight' => [
                    'create' => '750px',
                    'view' => '618px',
                ],
                'columnAfter' => false,
            ],
            
            'rightBtn' => [

                'add-clone-delete' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'filter-sort-id' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

                'statistics' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'system' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'export' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
                'toggleData' => [
                    'content' => '',
                    'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                ],
            ],
        ]);

        $this->pjaxEnd();

        ?>

        <script>

              $('#kv-align-center').click(function () {
                 window.location.href = '/core/dyna/items.aspx';
              })
        </script>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
