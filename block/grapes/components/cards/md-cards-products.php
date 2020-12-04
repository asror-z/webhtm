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
      .card-image {
          position: relative;
      }
      .product-logo {
          position: absolute;
          bottom: -20px;
          right: 20px;
          width: 50px;
          height: 40px;
          border-radius: 5px;
          box-shadow: 0 0 5px rgba(0, 0, 0, .3);
      }
      .product-logo img{
          border-radius: 5px;
          position: absolute;
          width: 100%;
          height: 100%;
      }
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
          color: red;
      }
      .card-icons i:last-child {
          color: green;
      }
      .card-price span{
          font-size: 12px;
      }
      .new-price {
          background: rgba(192, 192, 192, 0.32);
          padding: 3px
      }
      .old-price {
          font-size: 10px!important;
          text-decoration: red line-through;
      }
  </style>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container">
    <div class="row d-flex flex-wrap w-100">
        <div class="col-lg-3 my-2 mx-1" style="max-width: 200px;">
            <!-- Card -->
            <div class="card">

                <!-- Card image -->
                <div class="card-image careview overlay">
                    <img class="card-img-top" src="https://im0-tub-com.yandex.net/i?id=9aa9fd322628add223caee5fadfea5db&n=13" alt="Card image cap">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                    <div class="product-logo">
                        <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=13" alt="">
                    </div>
                </div>

                <!-- Card content -->
                <div class="card-body pt-4 pb-3 px-3">

                    <!-- Title -->
                    <h4 class="card-title m-0">Card title</h4>
                    <hr class="my-1">
                    <!-- Text -->
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
                        <span class="new-price">99,999 сум</span>
                        <span class="old-price">199,999 сум</span>
                    </div>
                </div>

                <!-- Card footer -->

            </div>
            <!-- Card -->
        </div>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


