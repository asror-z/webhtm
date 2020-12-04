<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;


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

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>


</head>


<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();


echo ZNProgressWidget::widget([]);

echo $this->require('\webhtm\cpas\blocks\header.php');
?>
<?
$this->userIdentity()->user_company_id;

?>
<div class="container-fluid">
    <div class="offers-header">
        <h2 class="text-muted"><?= Az::l('Офферы')?></h2>
        <div class="mt-1">
            <a href="/cpas/client/statistic.aspx" class="offer-header--text"><?= Az::l('Главная')?></a>
            <span class="offer-nav">/ <?= Az::l('Офферы')?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="d-flex flex-wrap">


            <form method="get" class="col-md-9 offer-search d-flex">
                <input type="text" name="search" class="textbox" placeholder="Искать офферы по названию"
                       id="searchInput">
                <input title="Search" value="" type="submit" class="button" id="searchSubmit">
            </form>


            <div class="col-md-9">
                <?php
                $model = new CpasOffer();

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
                            return $this->require('/webhtm/cpas/client/card.php', [
                                'id' => ZArrayHelper::getValue($model, 'id')
                            ]);
                        },
                        'layout' => "{items}\n{pager}"
                    ]
                ]);

                ?>
            </div>

            <div class="col-md-3 offer-right--panel">
                <div class="p-3">
                    <h5 class="right-panel--header"><?= Az::l('Создать поток')?></h5>
                </div>

                <div class="p-1">
                    <div class="px-2">
                        <h5 class="right-panel--text"><?= Az::l('Офферы')?></h5>
                        <?

                        $offers = CpasOffer::find()->all();
                        $data = [];
                        foreach ($offers as $offer) {
                            $data[$offer->id] = $offer->title;
                        }

                        echo ZSelect2Widget::widget([
                            'data' => $data,

                            'config' => [
                                'placeholder' => Az::l('Выбрать офферы'),
                                'ajax' => false,
                            ],
                            'active' => [
                                'select' => true
                            ],
                            'event' => [
                                'select' => <<<JS
                
                         console.log(event.target.value);
                         $('#offerSelecturl').attr('href', '/cpas/client/createFlow.aspx?id='+event.target.value);
                
JS,

                            ]
                        ]);

                        ?>
                    </div>
                </div>

                <div class="px-2 pt-1 w-100">

                    <a href="#" id="offerSelecturl" class="offer-panel-btn"><?= Az::l('Создать')?></a>

                </div>
            </div>

        </div>
    </div>
</div>


<? echo $this->require('\webhtm\cpas\blocks\footer.php'); ?>
<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
