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
    <div class="row text-center pb-0 pb-lg-4">
      <div class="col-12">
        <h1>Call To Action</h1>
      </div>
    </div>
    <div class="row text-center pt-4 pt-md-5">
      <div class="col-12 col-sm-10 col-md-6 col-lg-4 m-sm-auto ">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/gift.svg">
        <h3>First Action</h3>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts</p>
        <p class="mt-3"><a class="btn btn-light sl-1" href="#">Button</a></p>
      </div>

      <div class="col-12 col-sm-10 col-md-6 col-lg-4 ml-sm-auto mr-sm-auto mt-5 mt-md-0 fdb-action">
        <img alt="image" class="fdb-icon" src="/render/grapeAssets/styleComponents/images/icons/cloud.svg">
        <h3>Second Action</h3>
        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
        <p class="mt-3"><a class="btn btn-light sl-1" href="#">Button</a></p>
      </div>
    </div>
  </div>
</section>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


