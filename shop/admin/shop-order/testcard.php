<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWidgetShahzod;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Заказы';
$action->icon = 'fal fa-crosshairs';
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
          $model = new ShopOrder();

          if ($this->modelSave($model)) {

              /**
               *
               * Post save Actions
               */
              $this->paramSet(paramIframe, true);

              $this->urlRedirect([
                  'index',
                  'sort' => '-id'
              ]);
          }


          /*ZCardWidget::begin([
              'config' => [
                  'title' => Az::$app->view->title,
                  'type' => ZCardWidget::type['dynCard'],
              ]
          ]);*/

          $active = new Active();

          $form = $this->activeBegin($active);

          echo ZFormWidget::widget([
              'model' => $model,
              'form' => $form,
              'config' => [
                  'isCard' => true,
                  'title' => 'TEST'
              ]
          ]);

          $this->activeEnd();/*ZCardWidget::end()*/;

          ?>

      </div>
    </div>


  </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
