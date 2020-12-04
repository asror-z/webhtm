<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */


/** @var Models $model */

$modelClassName = $this->bootFullUrl();
$this->beginPage();

//   $this->timeBefore('1');
if (class_exists($modelClassName))
    $model = new $modelClassName();
else
    throw new NotFoundHttpException();


$action = new WebItem();

$action->title = Azl . $model->configs->title;
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;

if ($this->httpGet('spa'))
    $action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/**
 *
 * Start Page
 */


?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

  //  require Root . '/webhtm/block/metas/main.php';
//    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

vd(get_declared_classes());
vd(get_declared_interfaces());
vdd(get_declared_traits());

 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
