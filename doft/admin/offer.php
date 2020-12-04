<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\system\Az;
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

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();$this->userIdentity()->user_company_id;

    ?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Офферы</h2>
            <div style="padding: 1em; background: #fff; font-size: 13px; margin: 1em 0; text-transform: uppercase;">
                <a href="/cpas/admin/index.aspx">Главная</a><span> <strong>/</strong> Офферы</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php

                $urlof = ZUrl::to([
                    '/cpas/admin/createOffer',
                ]);

                echo ZButtonWidget::widget([
                    'config' => [
                        'url' => $urlof,
                        'text' => Az::l('Создать оффер'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'hasIcon' => false,
                        'btn' => true,
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);

                $urlit = ZUrl::to([
                    '/cpas/admin/createItem',
                ]);

                echo ZButtonWidget::widget([
                    'config' => [
                        'url' => $urlit,
                        'text' => Az::l('Создать элемент'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'hasIcon' => false,
                        'btn' => true,
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);

                $urlsi = ZUrl::to([
                    '/cpas/admin/createSite',
                ]);;
                echo ZButtonWidget::widget([
                    'config' => [
                        'url' => $urlsi,
                        'text' => Az::l('Создать сайт'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'hasIcon' => false,
                        'btn' => true,
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);


                echo ZButtonWidget::widget([
                    'id' => 'shop-catalog-id',
                    'config' => [
                        'url' => '/cpas/admin/catalogs.aspx',
                        'text' => Az::l('Загрузить данные'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                        'hasIcon' => false,
                        'btn' => true,
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);

                $model = new CpasOffer();

                /*$model->configs->query = CpasOffer::find()
                    ->where([
                        '!=', 'status', 'not_accepted'
                    ]);*/
                echo ZListViewWidget::widget([
                    'model' => $model,
                    'config' => [
                        'type' => ZListViewWidget::type['model'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->require( '/webhtm/cpas/admin/card.php', [
                                'id' => $model->id
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



<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
