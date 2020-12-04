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

    ?>
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');
      .gr-body {
          margin: 0;
          padding: 0;
          display: flex;
          justify-self: center;
          align-items: center;
          min-height: 100vh;
          font-family: 'Poppins', sans-serif;
      }
      .gr-container {
          width: 1200px;
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
          grid-gap: 15px;
          margin: 0 auto;
      }
      .gr-container .gr-card {
          position: relative;
          width: 300px;
          height: 400px;
          margin: 0 auto;
          background: #fff;
          box-shadow: 0 15px 60px rgba(0, 0, 0, .5);
      }
      .gr-container .gr-card .gr-face {
          position: absolute;
          bottom: 0;
          left: 0;
          width: 100%;
          height: 100%;
          display: flex;
          justify-content: center;
          align-items: center;
      }
      .gr-container .gr-card .gr-face.gr-face1 {

      }
      .gr-container .gr-card .gr-face.gr-face1 h2 {
          margin: 0;
          padding: 0;
      }
      .gr-container .gr-card:hover .gr-face.gr-face2 {
          height: 65px;
      }
      .gr-container .gr-card .gr-face.gr-face2 {
          background: #111;
          transition: .5s;
      }
      .gr-container .gr-card:nth-child(1) .gr-face.gr-face2 {
          background: linear-gradient(45deg, #3503ad, #f7308c);
      }
      .gr-container .gr-card:nth-child(2) .gr-face.gr-face2 {
          background: linear-gradient(45deg, #ccff00, #09afff);
      }
      .gr-container .gr-card:nth-child(3) .gr-face.gr-face2 {
          background: linear-gradient(45deg, #e91e63, #ffeb3b);
      }
      .gr-container .gr-card .gr-face.gr-face2:before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 50%;
          height: 100%;
          background: rgba(250, 250, 250, .1);
      }
      .gr-container .gr-card .gr-face.gr-face2 h2 {
          margin: 0;
          padding: 0;
          font-size: 10em;
          color: #fff;
          transition:.5s ;
          text-shadow: 0 2px 5px rgba(0,0,0,.2);
      }
      .gr-container .gr-card:hover .gr-face.gr-face2 h2 {
          font-size: 2em;
      }
      .gr-content {
          padding: 20px 18px 100px;
      }
  </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="gr-body">
    <div class="gr-container">
        <div class="gr-card">
            <div class="gr-face gr-face1">
                <div class="gr-content">
                    <h2>Lorem ipsum dolor sit amet, consectetur</h2>
                    <p>adipisicing elit. Ab cumque deserunt
                        doloremque eveniet explicabo inventore
                        non quaerat quibusdam quos? Animi fugiat
                        possimus quam quas saepe sequi sunt
                        temporibus ullam. Maxime!</p>
                </div>
            </div>
            <div class="gr-face gr-face2">
                <h2>01</h2>
            </div>
        </div>
        <div class="gr-card">
            <div class="gr-face gr-face3">
                <div class="gr-content">
                    <h2>Lorem ipsum dolor sit amet, consectetur</h2>
                    <p>adipisicing elit. Ab cumque deserunt
                        doloremque eveniet explicabo inventore
                        non quaerat quibusdam quos? Animi fugiat
                        possimus quam quas saepe sequi sunt
                        temporibus ullam. Maxime!</p>
                </div>
            </div>
            <div class="gr-face gr-face2">
                <h2>02</h2>
            </div>
        </div>
        <div class="gr-card">
            <div class="gr-face gr-face3">
                <div class="gr-content">
                    <h2>Lorem ipsum dolor sit amet, consectetur</h2>
                    <p>adipisicing elit. Ab cumque deserunt
                        doloremque eveniet explicabo inventore
                        non quaerat quibusdam quos? Animi fugiat
                        possimus quam quas saepe sequi sunt
                        temporibus ullam. Maxime!</p>
                </div>
            </div>
            <div class="gr-face gr-face2">
                <h2>03</h2>
            </div>
        </div>
    </div>
</div>



<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>


