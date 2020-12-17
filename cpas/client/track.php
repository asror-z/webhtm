<?php

/**
 *
 * @author Jakhongir Kudratov
 */

use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\former\cpas\CpasTrackForm;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\cpas\CpasStreamStats;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDatepickerWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Контроль заказа';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo $this->require('\webhtm\cpas\blocks\header.php');


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">

        <div class="row">
          <a href="/cpas/client/statistic.aspx"><button type="button" class="btn btn-primary"><?= Az::l('Статистика')?></button></a>
          <button type="button" class="btn btn-primary" disabled><?= Az::l('Конверсии')?></button>
            <div class="mt-5 col-md-12 col-12">

                <?php

//                $items = collect(CpasStreamItem::find()->all());
//                $users = collect(\zetsoft\models\user\User::find()->all());


                $model = new CpasTracker();

                $model->query = CpasTracker::find()
                    ->where(['not',[
                        'contact_name' => null
                    ]])->andWhere(['user_id' => $this->userIdentity()->id])
                    ->orderBy([
                        'id' => SORT_DESC
                    ]);

                $model->configs->changeSave = false;


                $model->configs->nameOn = [
                    'id',
                    'created_at',
                    'cpas_offer_id',
//                    'user_id',
                    'cpas_stream_item_id',
                    'contact_name',
                    'contact_phone',
                    'shop_order_id',
                    'status',

                ];

                /*$model->configs->after = [
                    'created_at' => [
                        [
                            'class' => ZKDataColumn::class,
                            'header' => Az::l('User'),
                            'width' => '100px',
                            'format' => 'html',
                            //'attribute' => 'user_id',
                            'mergeHeader' => false,
                            'filter' => true,
                            'filterType' => ZHInputWidget::class,

                            'value' => static function ($tracker, $key, $index, DataColumn $dataColumn) use ($items, $users) {

                                $item = $items->where(
                                    'id', ZArrayHelper::getValue($tracker, 'cpas_stream_item_id')
                                )->first();

                                if (!$item)
                                    return null;

                                $user = $users->where(
                                    'id', $item->user_id
                                )->first();

                                if ($user)
                                    return '<span class="">' . $user->email . '</span>';

                                return null;

                            }
                        ],



                    ],

                ];*/


                /*$model->configs->readonly = [
                    'id',
                    'created_at',
                    'cpas_stream_item_id',
                    'contact_name',
                    'contact_phone',
                    'shop_order_id',
                ];*/
                $model->configs->readonly = true;

                /*$model->configs->readonlyOn = [
                    'status'
                ];*/


                $model->configs->filterWidget = [
                    'created_at' => ZKDatePickerWidget::class
                ];
                $model->columns();

                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'showFooter' => false,
                        'titleSummary' => true,
                        'isCard' => false,
                        'columnBefore' => [
                            'social'
                        ],
                        'columnAfter' => false,
                        'hasToolbar' => false,
                        'search' => false,
                        'heighbody' => '100%',
                        'perfectScrollbar' => true,
                        'striped' => false,
                        'hasWidth' => false,
                        'summary' => true
                        //'panelTemplate' => "{items}",




                    ]
                ])

                ?>

            </div>

        </div>


    </div>

</div>


<? echo $this->require('\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
