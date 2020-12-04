<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
$action->icon = 'fa fa-globe';
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

        //require Root . '/webhtm/block/metas/main.php';
        require Root . '/webhtm/block/assets/App/main_arbit.php';

        $this->head();

        ?>

    </head>


    <body class="<?= ZWidget::skin['white-skin'] ?>">

    <?php

    $this->beginBody();

    echo $this->require( '\webhtm\cpas\blocks\header.php');



    ?>

    <div id="page">

        <?


        $this->userIdentity()->user_company_id;

        ?>
        <div class="mt-2">
            <div class="p-1 bg-white mx-1 p-3">
                <h2 class="text-muted"><?= Az::l('Офферы')?></h2>
                <a href="/cpas/admin/index.aspx"><?= Az::l('Главная')?></a><span> / <?= Az::l('Офферы')?></span>
            </div>
        </div>
        <div class="container-fluid grey lighten-5 pt-1">

            <div class="row">
                <div class="col-md-12 pt-2">
                    <?php

                    $model = new CpasOffer();

                    $urlof = ZUrl::to([
                        '/cpas/admin/createOffer',
                    ]);

                    echo ZButtonWidget::widget([
                        'config' => [
                            'url' => $urlof,
                            'text' => Az::l('Создать оффер'),
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                            'hasIcon' => false,
                            'btn' => true,
                            'class' => 'py-1 px-3 rounded',
                            'btnRounded' => false,
                        ]
                    ]);
                    
                    $model->configs->query = CpasOffer::find()
                        ->where([
                            '!=', 'status', 'not_accepted'
                        ])
                        ->orderBy([
                            'id' => SORT_DESC
                        ]);
                    echo ZListViewWidget::widget([
                        'model' => $model,
                        'config' => [
                            'type' => ZListViewWidget::type['model'],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->require( '/webhtm/cpas/admin/card.php', [
                                    'id' => ZArrayHelper::getValue($model, 'id')
                                ]);
                            },
                            'layout' => "{items}\n{pager}"
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>



    <? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

    <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>
