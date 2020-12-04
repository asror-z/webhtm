<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @license Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Потребности';
$action->icon = 'fal fa-graduation-cap';
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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?
                $this->pjaxBegin();
                /** @var ZActiveRecord $model */

                $model = new WareAccept();

                $model->configs->readonly = true;
                $model->configs->showDeleted = true;
                $model->configs->nameOn = [
                    'id',
                    'name',
                    'deleted_at',
                    'deleted_by',
                    'deleted_text',
                ];

                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightBtn' => [
                        'update' => [
                            'content' => '{update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        // start|MuminovUmid
                        'clear_update' => [
                            'content' => '{clear_update}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],
                        // end|MuminovUmid

                        'system' => [
                            'content' => /*'{system}'*/ '{delDyna}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'add-clone-delete' => [
                            'content' => '{choose}{add}{tabular}{clone}{delete}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'filter-sort-id' => [
                            'content' => '{dynagridFilter}{filter}{dynagridSort}{dynagridSettings}{dynagrid}',
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'statistics' => [
                            'content' => ''/*'{statistics}{report}'*/,
                            'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                        ],

                        'export' => [
                            'content' => '{jsonExcel}',/*{excelExport}{excelBosya}{exportAll}{export}*/
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],


                        'toggleData' => [
                            'content' => '{all}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],

                        // todo start Tursunaliyev Abdulloh

                        'filterPjax' => [
                            'content' => '{filterBtn}',
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    // todo start Lobar
                    'config' => [
                        'pjax' => false,
                        'columnBefore' => [
                            'checkbox',
                        ],
                        'columnAfter' => false,
                        'actionButtons' => [
                            'checkbox',
                        ]
                    ]
                    // todo end Lobar
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
