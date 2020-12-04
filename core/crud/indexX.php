<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLData;
use zetsoft\dbitem\data\ButtonItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaAblWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetAs;
use zetsoft\widgets\former\ZDynaWidgetOld_10_26_2020;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\inputes\ZFloatButtonRightWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */

/** @var Models $model */


$this->beginPage();


$action = new WebItem();


$modelClassName = $this->bootFullUrl();

if (class_exists($modelClassName))
    $model = new $modelClassName();
else
    throw new NotFoundHttpException();


$action->title = Azl . $model->configs->title;
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


?>

<div id="content" class="content-footer p-3">


  <div class="row">
    <div class="col-md-12 col-12">

        <?php


        $model->configs->orderCheck = true;
        $model->configs->type = ALLData::type['array'];

        /*$model->query = ShopOrder::find()
          ->where([
              'contact_phone' => '22-340-40-99'
          ]);*/

        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'config' => [
                'relateMany' => true,
                'relation' => true,
                'relateMulti' => true,
            ],
        ]);


        ?>
    </div>
  </div>
</div>


