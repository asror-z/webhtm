<?php

use kartik\grid\DataColumn;
use kartik\widgets\Alert;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\notifier\ZKGrowlWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Jakhongir Kudratov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
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


<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();


echo ZNProgressWidget::widget([]);

echo $this->require( '/webhtm/cpas/blocks/header.php');

?>
<?

?>
<div class="container-fluid">
    <div class="row">
        <div class="mx-auto col-md-11 col-11">
            <?

            //start|JakhongirKudratov|2020-10-14

            if (ZArrayHelper::getValue($this->httpGet(), 'land') === 'false')
            {
                echo ZKAlertWidget::widget([
                    'config' => [
                        'type' => Alert::TYPE_DANGER,
                        //'title' => '&nbsp' . '&nbsp' . Az::l('Предупреждение !'),
                        'body' => Az::l('Выберите хотябы один лендинг или прелендинг с формой!'),
                        'icon' => 'fas fa-exclamation-circle',
                        'delay' => 0,
                        'isShowSeparator' => true,
                    ]
                ]);
            }
            $id = $this->httpGet('id');
            $model = CpasStream::findOne($id);
            $offer_id = $model->cpas_offer_id;
            $active = new Active();
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            $model->configs->hasLabel = true;
            $model->configs->readonlyWidget = [
                'user_id',
                'cpas_offer_id'
            ];
            $model->cards = [
                [
                    'title' => Az::l('Первый этап'),
                    'items' => [

                        [
                            'title' => Az::l('Результат шт.'),
                            'items' => [
                                [
                                    'cpas_offer_id',
                                ],
                                [
                                    'user_id',
                                    'title',
                                ],
                                [
                                    'counter',
                                    'postback',
                                ],
                                [
                                    'sub1',
                                    'sub2',
                                    'sub3',
                                    'sub4',
                                    'sub5',
                                ],
                                [
                                    'utm_source',
                                    'utm_company',
                                    'utm_content',
                                    'utm_term',
                                ]
                            ],
                        ],
                        
                    ],
                ],
               
            ];
            $model->columns();
            echo ZFormBuildWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'btnTitle' => Az::l('Сохранить'),
                    'topBtn' => false,
                    'stepType' => ZFormBuildWidget::stepType['none'],
                    'blockType' => ZFormBuildWidget::blockType['naked']
                ]
            ]);
            $this->activeEnd();
            $items = CpasOfferItem::find()
                ->where([
                    'cpas_offer_id' => $offer_id
                ])
                ->all();
            $item_ids = ZArrayHelper::map($items, 'id', 'id');

            $newModel = new CpasLand();
            $newModel->query = CpasLand::find()
                ->where([
                    'cpas_offer_item_id' =>  $item_ids
                ]);
            $newModel->configs->nameOn = [
                'type',
                'cpas_offer_item_id',
                'place_country_id',
                'title',
            ];
            
            $newModel->configs->group = [
                'type' => true
            ];
            $newModel->configs->groupedRow = [
                'type' => true
            ];

            $newModel->configs->after = [
                'title' => [
                    [
                        'class' => ZKDataColumn::class,
                        'label' => Az::l('Посмотреть Лендинг'),
                        'width' => '150px',
                        'value' => function ($cpasLand, $key, $index, DataColumn $dataColumn) use ($model) {
                            $url = ZArrayHelper::getValue($cpasLand, 'path'). 'landing.html';

                            return ZButtonWidget::widget([
                                'config' => [
                                    'url' => $url,
                                    'title' => ZArrayHelper::getValue($cpasLand, 'title'),
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
                        'label' => Az::l('Скриншот лендинга'),
                        'width' => '150px',
                        'value' => function ($cpasLand, $key, $index, DataColumn $dataColumn) use ($newModel) {

                            $path = '/uploaz/' . App . '/' . $newModel->className . '/' . 'screen/' . ZArrayHelper::getValue($cpasLand, 'id') . '/' . ZArrayHelper::getValue(ZArrayHelper::getValue($cpasLand, 'screen'), 0) ;
                            return <<<HTML
                <img src="$path" style="width: 100px; height: 60px;">          
HTML;
                        }
                    ],

                ],

            ];
            $newModel->configs->readonly = true;
            
            $newModel->columns();
            echo ZDynaWidget::widget([
                'model' => $newModel,
                'config' => [
                    'hasToolbar' => false,
                    'columnBefore' => [
                        'checkbox',
                    ],
                    'viewUrl' => '{fullUrl}/view-process.aspx?id={id}',
                    'actionButtons' => [
                        'view'
                    ],
                    'spaHeight' => [
                        'create' => '800px',
                        'view' => '800px',
                    ],
                    'columnAfter' => false,
                    'search' => false,
                    'width' => '100%'
                ]
            ]);



            ?>
            <div class="text-right">
                <?php
                if ($this->modelSave($model)) {
                $user_id = $this->userIdentity()->id;
                $url = $this->urlArrayStr;
                $key = 'Checkdyna-CpasLand-'.$url .'-' . $user_id;
                $news = $this->sessionGet($key);
                  if (Az::$app->cpas->cpa->createStreamItem($news, $user_id, $model->id)){
                        $this->sessionDel($key);
                        $this->urlRedirect([
                        '/cpas/client/viewFlow',
                        'id' => $id,

                    ]);

                  }else{
                      $this->sessionDel($key);
                      $this->urlRedirect([
                            '/cpas/client/createNewAll',
                            'id' => $id,
                            'land' => 'false'
                        ]);
                    }
                }


                //end|JakhongirKudratov|2020-10-14


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
