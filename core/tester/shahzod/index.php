<?php

use Spatie\SchemaOrg\ShoppingCenter;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\UserContact;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetShahzod;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Пользователь';
$action->icon = 'fa fa-lastfm-square';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$model = new ShopProduct();
/*$model->configs->nameOn = [
    'text',
    'name',
    'text',
    'image',
];*/


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>

<head>
    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>
</head>
<html lang="<?= Yii::$app->language ?>">

  <?
  echo ZDynaWidget::widget([
      'model' => $model
  ])


  ?>




</html>
<style>
    
</style>

<?php $this->endPage() ?>
