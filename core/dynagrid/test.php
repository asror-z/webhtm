<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$modelName = $this->httpGet('modelName');
$id = $modelName . '-' . $this->userIdentity()->id;

$dynaConfig = DynaConfig::findOne([
    'dynaId' => $id
]);

if ($dynaConfig !== null) {
    $dynaConfig->delete();
}


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


    /** @var ZView $this */
    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

