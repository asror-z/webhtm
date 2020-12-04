<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageAction;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->loader = false;


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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?


    echo ZSessionGrowlWidget::widget(); ?>

  <div>


    <div class="row">
      <div class="col-md-12 col-12">

          <?
          
          //   Az::$app->params[paramsAction] = $action;

          $path = $this->httpGet('path');
          $path = str_replace('.php', '', $path);

          $file = Az::getAlias('@zetsoft/' . $path . '.php');

          echo $this->require($file, [], null, false);

          
          ?>

      </div>
    </div>


  </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
