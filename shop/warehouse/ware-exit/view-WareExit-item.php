<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareExit;
use zetsoft\models\ware\WareExitItem;
use zetsoft\system\Az;
use zetsoft\system\except\ZException;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Заказы';
$action->icon = 'fal fa-lock';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

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
    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">
                <?
                $this->pjaxBegin();
                $ware_exit_id = $this->httpGet('ware_exit_id');
                
                $ware_exit = WareExit::findOne(['id' => $ware_exit_id]);

                if ($ware_exit === null) {
                    throw new ZException(Az::l('Товар не найден.'));
                }

                $model = new WareExitItem();

                $model->configs->query = WareExitItem::find()
                    ->where([
                        'ware_exit_id' => $ware_exit_id
                    ]);

                $model->configs->readonly = true;

                $model->configs->title = $ware_exit->name;
                
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'leftBtn' => [
                        'status' => [
                            'content' => '',
                            'options' => ['class' => 'mx-3']
                        ],
                        'search' => [
                            'content' => '',
                            'options' => ['class' => ' p-1 mr-0 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                        'pjax' => false,
                        'columnBefore' => [
                            'checkbox',
                            'id',
                        ],
                        'actionButtons' => false,
                        'columnAfter' => false,
                    ],
                    'rightBtn' => [
                        'system' => [
                        'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'update' => [
                            'content' => '',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

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
            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
