<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\menu\Menu;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Редактирование  Меню';
$action->icon = 'fa fa-credit-card';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var ZView $this */
$this->beginPage();

$id = $this->httpGet('id');
$model = Menu::findOne($id);


if ($this->modelSave($model)) {
    $this->paramSet(paramIframe, true);
    $this->urlRedirect(['index', true]);
}

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

<div class="row">
    <div class="col-md-12 col-12">

        <?
        $this->beginBody();
        $form = $this->activeBegin();

        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        echo ZFormBuildWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        ZCardWidget::end();

        $this->activeEnd();

        $this->endBody()
        ?>

    </div>
</div>

</body>
</html>

<?php $this->endPage() ?>
