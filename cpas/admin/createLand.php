<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputBtnWidget;
use zetsoft\widgets\inputes\ZLibraInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание прихода в склад';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
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

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="mx-auto pt-3 col-md-11 col-11">

                <?

                $id = $this->httpGet('model-id');
                $attribute = $this->httpGet('attribute');
                $className = $this->httpGet('className');
                $offer_id = $this->httpGet('offer_id');
                $modelName = $this->bootFull($className);
                $model = new $modelName;


                $active = new Active();
                $active->method = Active::method['post'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $model->$attribute = $id;
                $model->configs->readonlyWidget = [
                    $attribute
                ];
                

                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                        ['cpas_offer_item_id'],
                                        ['title'],
                                        ['type'],
                                        ['status'],
                                        ['adaptive'],
                                        ['path'],
                                        ['archive'],
                                        ['screen'],
                                ],
                            ],
                        ],
                    ],
                ];


                $model->columns();
                echo ZLibraInputWidget::widget([
                    'config' => [
                        'objectName' => 'libra',
                        'mode' => ZLibraInputWidget::mode['manual'],
                        'inputSelector' => '#wareenteritem-weight',
                        'autorun' => true,
                    ],
                ]);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'cols' => 1,
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
                    ]
                ]);

                $this->activeEnd();


                if ($this->modelSave($model)) {
                    //vdd($model);
                    if (Az::$app->cpas->cpa->openArchive($id, $model))
                    {
                        //vdd($model);
                        $this->paramSet(paramIframe, true);

                        $this->urlRedirect([
                            '/' . $this->prelastUrl() . '/processItem',
                            'model' => $this->httpGet('model'),
                            'id' => $id,
                            'related' => $className,
                            'attribute' => $attribute,
                            'offer_id' => $offer_id
                        ]);
                    }

                    

                }

                ?>

            </div>

        </div>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
