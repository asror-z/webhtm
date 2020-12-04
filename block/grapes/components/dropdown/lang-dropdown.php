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
    $this->fileCss('/render/grapeAssets/styleComponents/responsiveCard.css');

    ?>

  <style>
      .lang-pick {
          position: relative;
      }
      .lang-pick:hover .lang-dropdown {
          transition: .2s ease-in-out;
          opacity: 1;
          z-index: 1;
      }
      .lang-pick .lang-dropdown {
          opacity: 0;
          z-index: -1;
          position: absolute;
          background: #fff;
          width: 180px;
          padding: .5em 1em;
          font-size: 11px;
          box-shadow: 0 0 5px rgba(0,0,0,.1);
      }

  </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container">
  <div class="lang-pick">
    <a href="#">Язык / Валюта</a>
    <div class="lang-dropdown">
      <span>Язык</span>
      <select class="mdb-select md-form" searchable="Search here..">
        <option value="" disabled selected>Choose your country</option>
        <option value="1">USA</option>
        <option value="2">Germany</option>
        <option value="3">France</option>
        <option value="3">Poland</option>
        <option value="3">Japan</option>
      </select>
      <label class="mdb-main-label">Label example</label>
      <span>Валюта</span>
      <select class="mdb-select md-form" searchable="Search here..">
        <option value="" disabled selected>Choose your country</option>
        <option value="1">USA</option>
        <option value="2">Germany</option>
        <option value="3">France</option>
        <option value="3">Poland</option>
        <option value="3">Japan</option>
      </select>
      <label class="mdb-main-label">Label example</label>
    </div>
  </div>
</div>

<?php $this->endBody() ?>

<script>
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
    });
</script>
</body>
</html>

<?php $this->endPage() ?>


