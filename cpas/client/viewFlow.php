<?php

/**
 *
 * @author JakhongirKudratov
 */



use kartik\grid\DataColumn;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasStreamItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\system\assets\ZColor;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;





/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Общая информация потока';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = true;
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


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php


$id = $this->httpGet('id');
$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');



?>

<div id="page" class="arbit/client/viewFlow">

    <div class="my-2 p-2 px-3 shadow-sm p-3 bg-white">
        <h2 class="text-muted"><?= Az::l('Общая информация потока')?></h2>
        <div>
            <a href="/cpas/client/statistic.aspx"><?= Az::l('Главная')?></a>
            <a href="/cpas/client/flows.aspx"> / <?= Az::l('Потоки')?></a>
            <span href="/cpas/admin/view.aspx?id=1"> / <?= Az::l('Общая информация потока')?> </span>
        </div>
    </div>

    <div class="container-fluid  grey lighten-4">
        <div class="row py-3">
            <div class="col-md-12 pb-2 mb-5">
                <?php


                /** @var ZView $this * */

                //start|JakhongirKudratov|2020-10-11

                $model = CpasStream::findOne($id);
                $offer = CpasOffer::findOne($model->cpas_offer_id);
                #errorCheck
                if ($model === null)
                    return $this->urlRedirect('/cpas/redirect/404.aspx');

                $urlupdate = ZUrl::to([
                    '/cpas/client/updateFlow',
                    'id' => $id,
                ]);
                $updateBtn = ZButtonWidget::widget([
                    'config' => [
                        'url' => $urlupdate,
                        'text' => Az::l('Обновить поток'),
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                        'btn' => true,
                        'icon' => 'fas fa-pencil-alt',
                        'class' => 'py-2 px-3',
                        'btnRounded' => false,
                    ]
                ]);


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::l('Общая информация потока'),
                        'type' => ZCardWidget::type['dynCard'],
                        'headerColor' => ZColor::color['green-special'],
                        'classHeadColor' => 'bg-white text-dark px-4 p-2',
                        'footerText' => '',
                        'hasFooter' => true,
                        'headerRight' => $updateBtn,
                        'footerColor' => ZColor::color['green-special'] . ' text-black',
                    ]
                ]); ?>

                <div class="row d-block px-3">

                    <table class="table table-hover text-center table-borderless">
                        <thead>
                            <th><?= Az::l('ID')?></th>
                            <th><?= Az::l('Название')?></th>
                            <th><?= Az::l('Оффер')?></th>
                            <th><?= Az::l('Ид каталога')?></th>
                            <th><?= Az::l('Идентификаторы счетчиков')?></th>
                        </thead>
                        <tbody class="text-dark font-weight-bold">
                            <tr>
                                <th class="text-dark"><?= $model->id?></th>
                                <th class="text-dark"><?= $model->title?></th>
                                <th class="text-dark"><?= $offer->title?></th>
                                <th class="text-dark"><?= $offer->catalog?></th>

                                <th class="text-dark">
                                    <?
                                    if (empty($model->counter))
                                        echo Az::l('Счетчиков не существует');
                                    else{
                                        $check = null;
                                        foreach ($model->counter as $key => $value)
                                        {
                                            if ($value){
                                                echo $key . '->' . $value;
                                                echo EOL;
                                                $check = $check.$value;
                                            }


                                        }
                                        if (empty($check))
                                            echo Az::l('Счетчиков не существует');

                                    }


                                    ?>

                                </th>

                            </tr>
                            

                        </tbody>
                    </table>

                </div>



                <? ZCardWidget::end(); ?><br>
               
            </div>

            <div class="col-md-12">

                <div class="mb-2">
                    <?php
                    ZCardWidget::begin([
                        'config' => [
                            'title' => Az::l('Общая информация элементы потока'),
                            'type' => ZCardWidget::type['dynCard'],
                            'classHeadColor' => 'bg-white text-dark',
                            //'headerRight' => $btn,
                            'footerText' => '',
                            'hasFooter' => true,
                            'footerColor' => ZColor::color['green-special'] . ' text-black',
                        ]
                    ]);

                    $lands = collect(CpasLand::find()->all());
                    $items = new CpasStreamItem();
                    $items->query = CpasStreamItem::find()
                        ->where([
                            'cpas_stream_id' => $id
                        ]);

                    $items->configs->readonly = true;
                    $items->configs->nameOn = [
                        'id',
                        'title',
                        'cpas_land_id',
                        'cpas_trans',
                        'cpas_trans_form',
                        //'track'
                    ];
                    $items->configs->after = [
                        'cpas_trans_form' => [
                            [
                                'class' => ZKDataColumn::class,
                                'label' => Az::l('Трекинг ссылка'),
                                'width' => '100px',
                                'value' => function ($item, $key, $index, DataColumn $dataColumn) {
                                    return ZButtonWidget::widget([
                                        'config' => [
                                            'url' => ZArrayHelper::getValue($item, 'track'),
                                            'title' => Az::l('Посмотреть'),
                                            'hasIcon' => true,          
                                            'isPjax' => false,
                                            'pjax' => false,
                                            'icon' => 'fal fa-external-link fa-lg',
                                            'btn' => false,
                                            'target' => ZButtonWidget::target['_blank'],
                                        ]
                                    ]);

                                }
                            ],

                            [
                                'class' => ZKDataColumn::class,
                                'label' => Az::l('Просмотр элемента'),
                                'width' => '150px',
                                'value' => function ($item, $key, $index, DataColumn $dataColumn) use($id,$lands) {

                                    $viewbtn = '';
                                    if(!empty(ZArrayHelper::getValue($item, 'cpas_land_id')))
                                    {
                                        $name = $lands->where('id',ZArrayHelper::getValue($item, 'cpas_land_id'))->first();
                                        $viewUrl = '/render/cpasite/'.$id.'/'.ZArrayHelper::getValue($item, 'id').'/'.$name->title.'/index.php';
                                        $viewbtn = ZButtonWidget::widget([
                                            'config' => [
                                                //'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                                'url' => $viewUrl,
                                                'icon' => 'fal fa-external-link fa-lg',
                                                'title' => Az::l('Посмотреть лендинг'),
                                                'btnRounded' => false,
                                                'btn' => false,
                                                'target' => ZButtonWidget::target['_blank'],
                                                'btnSize' => ZColor::btnSize['btn-sm'],

                                            ]
                                        ]);
                                    }

                                    $viewPreland = '';
                                    if(!empty(ZArrayHelper::getValue($item, 'cpas_trans')))
                                    {
                                        $name = $lands->where('id',ZArrayHelper::getValue($item, 'cpas_trans'))->first();
                                        //$viewUrl = '/render/cpasite/'.$id.'/'.$item->id.'/'.$name->title.'/index.php';
                                        $viewUrl = '/render/cpasite/'.$id.'/'.ZArrayHelper::getValue($item, 'id').'/'.$name->title.'_pre/index.php';
                                        $viewPreland = ZButtonWidget::widget([
                                            'config' => [
                                                //'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                                'url' => $viewUrl,
                                                'icon' => 'fal fa-external-link fa-lg',
                                                'title' => Az::l('Посмотреть прелендинг'),
                                                'btnRounded' => false,
                                                'btn' => false,
                                                'target' => ZButtonWidget::target['_blank'],
                                                'btnSize' => ZColor::btnSize['btn-sm'],

                                            ]
                                        ]);
                                    }

                                    $viewPreForm = '';
                                    if(!empty(ZArrayHelper::getValue($item, 'cpas_trans_form')))
                                    {
                                        $name = $lands->where('id',ZArrayHelper::getValue($item, 'cpas_trans_form'))->first();
                                        $viewUrl = '/render/cpasite/'.$id.'/'.ZArrayHelper::getValue($item, 'id').'/'.$name->title.'/index.php';
                                        $viewPreForm = ZButtonWidget::widget([
                                            'config' => [
                                                // 'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                                'url' => $viewUrl,
                                                'title' => Az::l('Посмотреть прелендинг с формой'),
                                                'icon' => 'fal fa-external-link fa-lg',
                                                'btnRounded' => false,
                                                'btn' => false,
                                                'target' => ZButtonWidget::target['_blank'],
                                                'btnSize' => ZColor::btnSize['btn-sm'],

                                            ]
                                        ]);
                                    }
                                    $downloadUrl = '/render/cpazips/'.ZArrayHelper::getValue($item, 'user_id').'/'.ZArrayHelper::getValue($item, 'id').'/'.ZArrayHelper::getValue($item, 'id').'.zip';

                                    $downBtn = ZButtonWidget::widget([
                                        'config' => [
                                            'btnType' => ZButtonWidget::btnType['link'],
                                            //'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                                            'title' => Az::l('Скачать'),
                                            'url' => $downloadUrl,
                                            'icon' => 'fas fa-download',
                                            'btn' => false,
                                            'btnRounded' => false,
                                            'download' => true,
                                            'btnSize' => ZColor::btnSize['btn-sm'],


                                        ]
                                    ]);
                                    $btns = '<div class="btn-group" role="group">';
                                    $btns .= $viewPreForm. $viewPreland. $viewbtn .$downBtn;
                                    $btns .= '</div>';
                                    return $btns;

                                }


                            ],
                            

                        ],

                    ];

                    $items->columns();
                    //vdd($cpasLand);

                    echo ZDynaWidget::widget([
                        'model' => $items,
                        'config' => [
                            'showFooter' => false,
                            'titleSummary' => true,
                            'isCard' => false,
                            'columnBefore' => [
                                'action'
                            ],
                            'actionButtons' => [
                                'delete',
                                'update',
                            ],
                            'spaArray' => [
                                'update' => false
                            ],
                            'columnAfter' => false,
                            'hasToolbar' => false,
                            'search' => false,
                            'heighbody' => '100%',
                            'summary' => true,
                            'perfectScrollbar' => false,
                            'striped' => false,
                            'hasWidth' => false,
                            'updateUrl' => '{fullUrl}/updateItem.aspx?id={id}&model={modelClassName}',
                        ]
                    ]);

                    ZCardWidget::end();

                    //end|JakhongirKudratov|2020-10-11

                    ?>
                </div>

            </div>


        </div>

    </div>

</div>

<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage()

?>
