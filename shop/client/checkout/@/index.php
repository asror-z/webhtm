<?php

use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\menus\ZSidebarWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = true;

$action->cache = false;


$action->call = function (){
};
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

echo ZSidebarWidget::widget([]);

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();
?>
    <h1>Salom</h1>
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
