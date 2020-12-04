<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareExit;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
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

$action->title = Azl . 'Создание Поступление товаров в склад';
$action->icon = 'fal fa-film';
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

?>

<div id="page">

    <?
    if (!$this->httpGet('spa')) {
        require Root . '/webhtm/block/navbar/mainAdmin.php';
        require Root . '/webhtm/block/menu/menu-m_old.php';
    }

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row pt-5">
            <div class="mx-auto col-md-11 col-11">

                <?


                $id = $this->httpGet('id');
                $model = new WareExit();

                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_exit_id' => $model->id,
                    ]);
                }


                $active = new Active();
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                //                $model->responsible = $this->userIdentity()->id;
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'name',
                                        'date',
                                        'user_company_id',
                                        'ware_id',
                                        'shop_courier_id',
                                        'responsible',
                                        'comment',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];

                //$model->responsible = 99;
                $model->responsible = $this->userIdentity()->id;

                $model->date = Az::$app->cores->date->dateTime();


                $model->configs->widget = [
                    'date' => ZInputWidget::class
                ];

                $model->configs->nameOff = [
                    'name'
                ];

                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ]
                ]);

                $this->activeEnd();

                ?>

            </div>
        </div>


    </div>

</div>

<?
if (!$this->httpGet('spa'))
    require(Root . '/webhtm/block\footer\mplace\footerAll.php')

?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
