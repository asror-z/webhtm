<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\menu\Menu;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$action = new WebItem();

$action = new WebItem();
$action->title = Azl . 'Проверка покупки';
$action->icon = 'fa fa-area-chart';
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

/** @var ZView $this */
$id = $this->httpGet('id');
$model = new Menu();

if ($this->modelSave($model))
{

    /**
     *
     * Post save Actions
     */

    $this->urlRedirect(['index', true]);
}



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
/*require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';*/?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $form = $this->activeBegin();
        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['null'],
            ]
        ]);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        ZCardWidget::end();

        $this->activeEnd();

        ?>

    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
