<?php

use yii\web\View;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


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
    $this->fileCss('/render/asrorz/css/adminnn.css');
    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>" id="scrollbar">
<?php
$this->beginBody();

?>



<?php


?>

<div id="page">


  <div id="content" class="content-footer p-3">
    <div class="row">
      <div class="col-md-12 col-12">
          <?
          echo $this->require($content);
          ?>
      </div>
    </div>
  </div>
</div>



<?php $this->endBody() ?>

<style>
  #scrollbar::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(51, 51, 51, 0.2);

    background-color: #fff;
  }

  #scrollbar::-webkit-scrollbar {
    width: 8px;
    background-color: #fff;
  }

  #scrollbar::-webkit-scrollbar-thumb {
    background-color: #37f;
  }

</style>

</body>
</html>

<?php $this->endPage() ?>
