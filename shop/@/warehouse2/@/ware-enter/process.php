<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование';


$action->icon = 'fal fa-film';
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
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';


    echo ZSessionGrowlWidget::widget();?>


    <div class="row p-3">
        <div class="mx-auto col-md-12">

            <?

            $ware_enter_id = $this->httpGet('ware_enter_id');

            $ware_enter = WareEnter::findOne($ware_enter_id);

            if ($this->modelSave($ware_enter))
                $this->urlRedirect(['index', true]);

            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);


            $ware_enter->responsible = $this->userIdentity()->id;
            //$ware_enter->responsible = 156;


            $ware_enter->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'items' => [
                        [
                            'title' => Az::l('Форма'),
                            'items' => [
                                [
                                    'name',
                                    'date'
                                ],
                                [
                                    'ware_id',
                                    'responsible'
                                ],
                                [
                                    'user_company_id',
                                    'comment',
                                ],
                            ],
                        ],
                    ],
                ]
            ];

            $ware_enter->configs->hasLabel = true;

            $ware_enter->configs->readonlyWidgetOff = [
                'comment'
            ];

            $ware_enter->columns();

            echo ZFormBuildWidget::widget([
                'model' => $ware_enter,
                'form' => $form,
                'config' => [
                    'btnTitle' => Az::l('Сформировать и закрыть'),
                    'botBtn' => false,
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked']
                ]
            ]);

            $this->activeEnd();

            ?>

        </div>


        <div class="col-md-12 mx-auto mt-5">

            <?

            $ware_enter_item = new WareEnterItem();

            $ware_enter_item->configs->query = WareEnterItem::find()
                ->where([
                    'ware_enter_id' => $ware_enter_id
                ]);

            $ware_enter_item->configs->dynaButtons = [
                'update' => [
                    'content' => "{update}",
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],
                'add-tabular-clone-delete' => [
                    'content' => "{add}{clone}{delete}",
                    'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
                ],

            ];

            $ware_enter_item->columns();

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $ware_enter_item,
                'config' => [
                    'hasToolbar' => true,
                    'columnBefore' => [
                        'serial',
                        'action',
                        'checkbox',
                        'id'
                    ],
                    'viewUrl' => '{fullUrl}/view-process.aspx?id={id}',
                    'actionButtons' => [
                        'clone',
                        'delete',
                        'view'
                    ],
                    'spaHeight' => [
                        'create' => '800px',
                        'view' => '800px',
                    ],
                    'columnAfter' => false,
                    'deleteAllUrl' => '/api/core/dyna/delete-all.aspx?modelClassName={modelClassName}&ware_enter_id=' . $ware_enter_id,
                    'createUrl' => '{fullUrl}/create-process.aspx?ware_enter_id=' . $ware_enter_id,
                    'createTitle' => Az::l('Создание прихода в склад')
                ]

            ]);
            ?>

        </div>

    </div>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
