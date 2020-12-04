<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\calls\CallsCdr;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр Звонки колл центра';
$action->icon = 'fal fa-comment-alt';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


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

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget(); ?>

  <div id="content" class="content-footer p-3">


    <div class="row">
      <div class="col-md-12 col-12">
          <?
          $id = $this->httpGet('id');
          $model = CallsCdr::findOne($id);

          $isCard = true;
          if ($this->httpGet('spa'))
              $isCard = false;

          echo ZViewWidget::widget([
              'model' => $model,
              'config' => [
                  'isCard' => $isCard
              ]
          ]);

          ?>
      </div>
    </div>


  </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
