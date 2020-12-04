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

<section class="fdb-block">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-5 text-center pb-md-5">
        <h1>ZetSoft Design Blocks</h1>
        <p class="lead">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
        <p class="mt-4"><a href="#" class="btn btn-primary">Call to Action</a></p>
      </div>
    </div>

    <div class="row text-center justify-content-center pt-5">
      <div class="col-12 col-sm-6 col-lg-3">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/cloud.svg">

        <h3><strong>Feature One</strong></h3>

        <p>Far far away, behind the word mountains, far from the countries</p>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 pt-4 pt-sm-0">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/gift.svg">

        <h3><strong>Feature Two</strong></h3>

        <p>Separated they live in Bookmarksgrove right at the coast</p>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 pt-4 pt-lg-0">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/github.svg">

        <h3><strong>Feature Three</strong></h3>

        <p>A small river named Duden flows by their place and supplies it</p>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 pt-4 pt-lg-0">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/compass.svg">

        <h3><strong>Feature Four</strong></h3>

        <p>Far far away, behind the word mountains, far from the countries</p>
      </div>
    </div>
  </div>
</section>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


