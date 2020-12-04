<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\test\TestOrder;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Модификации';
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


    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto col-md-11 col-11">

                <?
                $modelClassName = $this->httpGet('modelClassName');

                if (empty($modelClassName))
                    $modelClassName = ZInflector::camelize($this->urlData(1));

                $modelClass = $this->bootFull($modelClassName);

                $this->paramSet(paramChangeReloadId, 'crud-pjax');

                $id = $this->httpGet('id');

                /** @var ZActiveRecord $modelClass */
                if (!empty($id))
                    $model = $modelClass::findOne($id);
                else
                    $model = new $modelClass();


                $attr = $this->httpGet('attribute');
                $url = $this->httpGet('url');

                $model->configs->nameShow = [$attr];
                $column = $model->columns[$attr];

                $model->configs->changeSave = $column->changeSave;
                $model->configs->changeReload = $column->changeReload;

                $model->columns();

                if ($this->httpIsPost()) {

                    $this->modelSave($model);
                    if (!$model->configs->changeReload) {
                        $this->paramSet(paramIframe, true);
                        // $this->modelPost();
                        $this->urlRedirect('/' . $url, true);
                    }
                }

                $form = $this->activeBegin(function (Active $active) {
                    return $active;
                });

                if (!$model->configs->changeReload)
                    $config = [
                        'topBtn' => true,
                        'isForm' => true,
                        'topBtnType' => ZButtonWidget::btnType['submit'],
                        'botBtn' => false,
                    ];
                else
                    $config = [
                        'topBtn' => true,
                        'isForm' => true,
                        'topBtnType' => ZButtonWidget::btnType['button'],
                        'topBtnEvent' => [
                            'click' => <<<JS
                      
                           var parentWindow = window.parent.document;
                           var panel = parentWindow.getElementById('jsPanel-edit-dyna')
                           console.log(parentWindow);
                                                        
                           var id = 'jamster-$modelClassName';
                           var button = parentWindow.getElementById(id);
                           console.log(id);
                           console.log(button);
                           $(button).trigger('click');
                           
                           panel.close();
               
JS
                        ],
                        'botBtn' => false,
                    ];


                $this->sessionSet(sessionFormConfigs, $config);

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => $config
                ]);


                $this->activeEnd();

                ?>

            </div>
        </div>


    </div>

</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
