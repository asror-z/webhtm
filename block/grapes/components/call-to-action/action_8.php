<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

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
    $this->fileCss('/render/grapeAssets/styleComponents/component-style.css');

    ?>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<section class="fdb-block py-0">
  <div class="container py-5 my-5" style="background-image: url(/render/grapeAssets/styleComponents/images/shapes/2.svg);">
    <div class="row justify-content-center py-5">
      <div class="col-12 col-md-10 col-lg-8 text-center">
        <div class="fdb-box">
          <h1>Call to Action</h1>
          <p class="lead">
            Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts
          </p>
          <p class="mt-4">
            <a class="btn btn-primary" href="#">Download</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


