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
      body {
          margin: 0;
          padding: 0;
      }
      .trending-category ul {
          display: flex;
          position: relative;
      }
      .trending-category ul li {
          display: flex;
      }
      .trend {
          margin-right: -70px;
          transition: .5s ease-in-out;
          z-index: 1;
      }
      .trend:hover {
          transition: .4s ease;
          margin-right: 1px;
      }
      .trending-category ul li a{
          display: flex;
          flex-direction: column;
          color: #222;
          text-decoration: none;
      }
      .trending-category .trend-title{
          padding: 10px 0;
          overflow: hidden;
          width: 50%;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
          transition: .2s ease-in-out;
      }
      .trending-category .trend-title:last-child {
          width: 100%;
      }
      .trend:hover .trend-title{
          width: 100%;
      }
      .trending-category ul li img {
          width: 150px;
          border-radius: 10px;
          height: 200px;
      }
  </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container">
  <div class="trending-category">
    <ul class="flex">
      <li class="trend"><a href="#">
          <span class="trend-title">Бытовая техника</span>
          <img src="https://i0.wp.com/womensovetfour.ru/wp-content/uploads/2020/05/315.jpg?fit=833%2C759&ssl=1" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Аксессуары</span>
          <img src="https://im0-tub-com.yandex.net/i?id=b011088efe0eef4a2c8e32602a0eb581&n=13" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Для мужчин и женщин</span>
          <img src="https://im0-tub-com.yandex.net/i?id=2a45578a9798459c43ea278132f26032&n=13" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Телефоны и гаджеты</span>
          <img src="https://im0-tub-com.yandex.net/i?id=28e2793e687b1559c467423cec7c1a07&n=13" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Товары для дома</span>
          <img src="https://im0-tub-com.yandex.net/i?id=0c6f88fc89ba619800c086a5619a66af&n=13" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Книги</span>
          <img src="https://im0-tub-com.yandex.net/i?id=e142f7c0a0da0cbd47e97b49b1d3b09d&n=13" alt="photo">
        </a></li>
      <li class="trend"><a href="#">
          <span class="trend-title">Другие категории</span>
          <img src="https://im0-tub-com.yandex.net/i?id=d40c1bb47e8a7d9879a1fba580a965f8&n=13" alt="photo">
        </a></li>
    </ul>
  </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


