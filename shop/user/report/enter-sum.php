<?php

/**
 *
 *
 * @license SherzodMangliyev
 *
 */

use FontLib\Table\Type\name;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Характеристика';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

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

?>

<div id="content" class="container-fluid">
    <?php
        /** @var Zview $this */
         $ids = $this->httpGet('ids');
         $ids = explode("|",$ids);
         $modelClass = $this->bootFull($this->httpGet('modelClass'));

         $model = new $modelClass();
         $model->configs->query = $modelClass::find()
            ->where([
                'id' => $ids
            ]);

            echo ZDynaWidget::widget([
                'model' => $model
            ]);
    ?>

</div>
<?php
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>






