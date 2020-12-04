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
    $this->fileCss('/render/grapeAssets/styleComponents/toolbarIcons.css');
    $this->fileCss('https://fonts.googleapis.com/icon?family=Material+Icons');


    ?>
    <style>
        .empty-stars {
            color: #ffca1b;
            cursor: pointer;
        }
        .empty-stars i {
            font-size: 10px;
        }
        .card-icons i {
            font-size: 18px;
            cursor: pointer;
        }
        .card-icons i:first-child {
            margin-right: 8px;
            color: #555;
        }
        .card-icons i:last-child {
            color: #555;
        }
        .card-icons i:first-child:hover {
            transition: .2s ease-in-out;
            color: red;
        }
        .card-icons i:last-child:hover {
            transition: .2s ease-in-out;
            color: #01a001;
        }
        .card-price span{
            font-size: 12px;
        }
    </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container-fluid py-3 px-5">
    <div class="row">
      <div class="row col-lg-12">
        <div class="shop-title col-12 d-flex align-items-center justify-content-between">
          <h3 class="d-flex align-items-center">Новинки <span class="badge badge-success fp-13 ml-1">New</span></h3>
          <a href="#">Cмотреть все</a>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
          <div class="col mb-4">
            <!-- Card -->
            <div class="card">

              <!--Card image-->
              <div class="view overlay">
                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/16.jpg"
                     alt="Card image cap">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>

              <!--Card content-->
              <div class="card-body pt-2 px-3 pb-3">

                <!--Title-->
                <h4 class="card-title">Card title</h4>
                <!--Text-->
                <div class="d-flex justify-content-between py-1">
                  <div class="empty-stars d-flex align-items-center">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </div>
                  <div class="card-icons d-flex align-items-center">
                    <i class="fad fa-heart-circle"></i>
                    <i class="fad fa-chart-bar"></i>
                  </div>
                </div>
                <div class="card-price d-flex justify-content-between align-items-center">
                  <span class="text-white success-color accent-4 fp-14 rounded-pill" style="padding: 2px 5px">99,999 сум</span>
                </div>

              </div>

            </div>
            <!-- Card -->
          </div>
        </div>
      </div>
    </div>
</div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>




