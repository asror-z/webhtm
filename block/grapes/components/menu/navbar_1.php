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

<header>
  <div class="container">
    <nav class="navbar navbar-expand-md">
      <a class="navbar-brand" href="https://www.froala.com">
        <img src="./imgs/logo.png" height="30" alt="image">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="https://www.froala.com">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com">Team</a>
          </li>
        </ul>

        <ul class="navbar-nav justify-content-end d-none d-lg-flex ml-md-auto">
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com"><i class="fab fa-slack"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com"><i class="fab fa-twitter"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.froala.com"><i class="fab fa-github"></i></a>
          </li>
        </ul>

        <a class="btn btn-outline-primary ml-md-3" href="https://www.froala.com">Button</a>
      </div>
    </nav>
  </div>
</header>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


