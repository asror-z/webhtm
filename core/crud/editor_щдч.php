<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Изменение данных';
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
    //  echo ZSessionGrowlWidget::widget();


    ?>


    <div class="row">
        <div class="mx-auto col-md-11 col-11">

            <?

            //start:TursunaliyevAbdulloh

            $id = $this->httpGet('key');

            $modelClassName = $this->httpGet('modelClassName');

            if (empty($modelClassName))
                $modelClassName = ZInflector::camelize($this->urlData(1));


            $modelClass = $this->bootFull($modelClassName);

            /** @var ZActiveRecord $modelClass */
            if (!empty($id))
                $model = $modelClass::findOne($id);
            else
                $model = new $modelClass();


            $attr = $this->httpGet('attribute');
            $url = $this->httpGet('url');

            $model->configs->nameOn = [$attr];
            $column = $model->columns[$attr];

            $model->configs->changeSave = $column->changeSave;
            $model->configs->changeReload = $column->changeReload;

            $model->columns();

            if ($this->modelSave($model)) {

                $this->paramSet(paramIframe, true);
                if (!$model->configs->changeReload)
                    $this->urlRedirect('/' . $url, true);

            }

            $active = new Active();
            $active->method = Active::method['post'];
            $active->type = Active::type['vertical'];
            $active->childClass = 'my-3';

            $form = $this->activeBegin($active);

            $this->pjaxBegin(function (ZPjax $pjax) {
                $pjax->id = 'crud-create-pjax';
                return $pjax;
            });

            $this->paramSet(paramChangeReloadId, 'crud-create-pjax');
            $model->columns();

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
                        function () {
                           var parentWindow = window.parent.document;
                           var panel = parentWindow.getElementById('jsPanel-edit-dyna')
                           
                           localStorage.setItem('edit', 'true');
                           panel.close();
                        }
JS
                    ],
                    'botBtn' => false,
                ];

            $this->sessionSet('formConfigs', $config);

            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => $config
            ]);

            $this->pjaxEnd();

            $this->activeEnd();

            //end:TursunaliyevAbdulloh

            ?>

        </div>
    </div>


</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
