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
    <div class="row">
      <div class="col-12 text-center">
        <h1>Froala Design Blocks</h1>
        <p class="h2">
          Far far away, behind the word mountains, far from.
        </p>
      </div>
    </div>

    <div class="row align-items-center pt-2 pt-lg-5">
      <div class="col-12 col-md-8 col-lg-7">
        <h2>Call to action</h2>
        <p class="lead">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
        <p class="mt-4"><a class="btn btn-primary" href="#">Take a Tour</a></p>
      </div>

      <div class="col-8 col-md-4 m-auto m-md-0 ml-md-auto pt-5">
        <img alt="image" class="img-fluid" src="/render/grapeAssets/styleComponents/images/draws/git.svg">
      </div>
    </div>
  </div>
</section>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


