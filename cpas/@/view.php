<?php

use phpDocumentor\Reflection\DocBlock\Description;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\images\ZHImgWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZDownloadWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZCardWidgetShahzod;
use zetsoft\widgets\values\ZSuffixWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
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


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/admin.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid  grey lighten-5">
        <div class="mt-2">
            <h2 class="text-muted">Детали оффера</h2>
            <?php
            $id = $this->httpGet('id');
            if (isset($id))
                echo ZBreadcrumbsWidget::widget([
                    'config' => [
                        'mode' => ZBreadcrumbsWidget::mode['page'],
                        'category_id' => $id
                    ]
                ]);
            ?>
        </div>
        <div class="row">
            <div class="col-md-4 pb-2">
                <?php


                /** @var ZView $this**/




                $model = CpasOffer::findOne($id);
                $title = $model->title;
                $footer = $model->text;
                ZCardWidget::begin([
                    'config' => [
                        'title' => $title,
                        'type' => ZCardWidget::type['dynCard'],
                        'headerColor' => ZColor::color['green-special'],
                        'classHeadColor' => 'bg-white text-dark px-4 pb-3',
                        'footerText' => '',
                        'hasFooter' => true,
                        'footerColor' => ZColor::color['green-special'] . ' text-black',
                    ]
                ]);?>

                <div class="row d-block">
                    <div class="px-4 pb-3">

                        <img class="rounded w-100" height="auto" src="<?='/uploaz/' . App . '/' . $model->className . '/' . 'photos/' . $model->id . '/' . ZArrayHelper::getValue($model->photos, 0)?>" alt="rasm">

                    </div>
                  
                        <?
                        $model->configs->nameOn = [
                            'title',
                            'text',
                            'type_substance',
                            'user_company_id',
                            'composition',
                            'deliver',
                            'photos',
                            'promo',
                            'call_center',
                            'audience',
                            'limit',
                        ];
                        $model->configs->valueWidget = [
                            'photos' => ZDownloadWidget::class,
                            'title' => ZSuffixWidget::class
                        ];
                        $model->configs->valueOptions = [
                            'title' => [
                                'config' => [
                                    'suffix' => function(CpasOffer $model){
                                        if (empty($model->status))
                                            return null;
                                        $status = $model->_status[$model->status];
                                        switch ($model->status){
                                            case 'new':
                                                $color = 'green';
                                                break;
                                            case 'blocked':
                                                $color = 'red';
                                                break;
                                            default:
                                                return null;
                                        }
                                        $htm = <<<HTML
<sup class="ml-3 {$color} text-white p-1 rounded-0">
    {$status}
</sup>
HTML;


                                        return $htm;
                                    }
                                ]
                            ]
                        ];

                        $model->columns();

                        echo ZViewWidget::widget([
                            'model' => $model
                        ]);

                        ?>
              
            
                    <?php

                        $url = ZUrl::to([
                            '/cpas/main/createFlow',
                            'id' => $id,
                        ]);
                        echo ZButtonWidget::widget([
                            'config' => [
                                'url' => $url,
                                'text' => Az::l('Создать поток'),
                                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                                'color' => ZColor::btnStyle['btn-success'],
                                'btnType' => ZButtonWidget::btnType['link'],
                                'hasIcon' => false,
                                'btn' => true,
                                'class' => 'py-2 px-3',
                                'btnRounded' => false,
                            ]
                        ]);
                        ?>

                </div>

                <?ZCardWidget::end();?>

            </div>

            <div class="col-md-8">

                <div class="mb-2">
                    <?php


                    $country_id = $this->httpGet('country');
                    $data = Az::$app->cpas->cpasSite->getCountry($id);
                    ZCardWidget::begin([
                        'config' => [
                            'title' => ' ',
                            'type' => ZCardWidget::type['dynCard'],
                            'headerColor' => ZColor::color['green-special'],
                            'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                            'footerText' => '',
                            'hasFooter' => true,
                            'footerColor' => ZColor::color['green-special'] . ' text-black',
                        ]
                    ]);
                    echo ZKSelect2Widget::widget([
                        'data' => $data,
                        'name' => 'countries',
                        'value' => $country_id,
                        'config' => [
                            'placeholder' => Az::l('Выберите страну ...'),
                            'hasPlace' => true,
                        ],
                        'event' => [
                            'select' => <<<JS
                function() {
                 window.location.href = '/cpas/main/view.aspx?id={$id}&country=' + $(this).val();        
                }
JS,

                        ]
                    ]);

                    ZCardWidget::end();
                    ?>
                </div>
                <div class="mb-2">
                     <?php
                 ZCardWidget::begin([
                     'config' => [
                         'title' => 'Лендинги',
                         'type' => ZCardWidget::type['dynCard'],
                         'headerColor' => ZColor::color['green-special'],
                         'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                         'footerText' => '',
                         'hasFooter' => true,
                         'footerColor' => ZColor::color['green-special'] . ' text-black',
                     ]
                 ]);




                 $lending = new CpasLand();


                 if($country_id){
                     $lending->query = CpasLand::find()
                         ->where([
                             'cpas_offer_id' => $id,
                             'type' => CpasLand::type['landing'],
                             'place_country_id' => $country_id
                         ]);


                 }else{
                     $lending->query = CpasLand::find()
                         ->where([
                             'cpas_offer_id' => $id,
                             'type' => CpasLand::type['landing'],
                         ]);


                 }


                 $lending->configs->nameOn = [
                     'name',
                     'cr',
                     'status',
                     'place_country_id',
                     'link',
                     'cpas_offer_id',
                 ];

                 $lending->configs->readonlyAll = true;


                 $lending->configs->width = [
                     'name' => '80px',
                     'cr' => '80px',
                     'status' => '80px',
                     'place_country_id' => '80px',
                     'link' => '80px',
                     'cpas_offer_id' => '80px',
                 ];


                 $lending->columns();
                 

                 echo ZDynaWidget::widget([
                     'model' => $lending,
                     'config' => [

                         'showFooter' => false,
                         'titleSummary' => true,
                         'isCard' => false,
                         'columnBefore' => false,
                         'columnAfter' => false,
                         'hasToolbar' => false,
                         'search' => false,
                         'heighbody' => '100%',
                         'filter' => false,
                         'summary' => true,
                         'perfectScrollbar' => false,
                         'striped' => false,
                         'panelTemplate' => "{items}",
                     ]
                 ]);

                 ZCardWidget::end();
                 ?>
                </div>

                 <div class="mb-2">
                     <?php
                     ZCardWidget::begin([
                         'config' => [
                             'title' => 'Прелендинги',
                             'type' => ZCardWidget::type['dynCard'],
                             'headerColor' => ZColor::color['green-special'],
                             'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                             'footerText' => '',
                             'hasFooter' => true,
                             'footerColor' => ZColor::color['green-special'] . ' text-black',
                         ]
                     ]);



                     $country_id = '';

                     $data = Az::$app->cpas->cpasSite->getCountry($id);
                     $country_id = $this->httpGet('country');

                     $prelending = new CpasLand();
                     if($country_id){
                         $prelending->query = CpasLand::find()
                             ->where([
                                 'cpas_offer_id' => $id,
                                 'type' => CpasLand::type['prelanding'],
                                 'place_country_id' => $country_id
                             ]);

                     }else{
                         $prelending->query = CpasLand::find()
                             ->where([
                                 'cpas_offer_id' => $id,
                                 'type' => CpasLand::type['prelanding'],
                             ]);
                     }



                     $prelending->configs->nameOn = [
                         'name',
                         'cr',
                         'status',
                         'place_country_id',
                         'link',
                         'cpas_offer_id',
                     ];

                     $prelending->configs->readonlyAll = true;


                     $prelending->columns();
                     
                     echo ZDynaWidget::widget([
                         'model' => $prelending,
                         'config' => [

                             'showFooter' => false,
                             'titleSummary' => true,
                             'isCard' => false,
                             'columnBefore' => false,
                             'columnAfter' => false,
                             'hasToolbar' => false,
                             'search' => false,
                             'heighbody' => '100%',
                             'filter' => false,
                             'summary' => true,
                             'perfectScrollbar' => false,
                             'striped' => false,
                             'panelTemplate' => "{items}",
                         ]
                     ]);

                     ZCardWidget::end();
                     ?>
                 </div>
            </div>
        </div>
    </div>

    <!--    --><?//= $this->require( '/webhtm/block/footer/cpas/footerAdmin.php') ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
