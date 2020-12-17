<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZAdminCardWidgetNew;
use zetsoft\widgets\themes\ZTabWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'ArbitPro';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;


$action->loader = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>
  <link rel="stylesheet" href="/render/asrorz/css/arbit.css">


</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">


<?php
$current_user = $this->userIdentity();
if ($current_user !== null) {
    $role = $current_user->role;
    switch ($role) {
        case 'admin':
            return $this->urlRedirect('/cpas/admin/statistic.aspx');
            break;
        case 'client':
            return $this->urlRedirect('/cpas/client/statistic.aspx');
            break;
    }
}

$users = User::find()->count();
$offers = CpasOffer::find()->count();
$money = 300;
//$month = time();
//$percent = \zetsoft\models\user\User::find()->where(['modified_at' => $month])->count();
//vdd($percent);
$now = Az::$app->cores->date->dateTime_Month_Start();
$per_users = User::find()
    ->where([
        '>', 'created_at', $now
    ])->count();

$per_offers = CpasOffer::find()
    ->where([
        '>', 'created_at', $now
    ])->count();
$this->beginBody();
if ($users === 0)
    $per_u = 0;
else
    $per_u = number_format($per_users / $users * 100, 2);
if ($offers === 0)
    $per_o = 0;
else
    $per_o = number_format($per_offers / $offers * 100, 2);


?>

<div id="page">

  <!--    <header class="header">-->
  <!--        <div class="section-header d-flex justify-content-between align-items-center">-->
  <!--            <div class="brend ml-5">-->
  <!--                <h3 class="text-white">Arbit</h3>-->
  <!--            </div>-->
  <!--            <div class="header-auth mr-5">-->
  <!--                <a class="btn btn-white btn-rounded text-dark font-weight-bold" href="/cpas/user/login-register.aspx">-->
    <? //= Az::l('Авторизация')?><!--</a>-->
  <!--            </div>-->
  <!--        </div>-->
  <!--    </header>-->


  <div id="content" class="content-footer">


    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="tatsu-row row">
              <div class="content-image">
                <img src="/render/asrorz/arbit/img/Zeydoo_ill.png" alt="">
              </div>
              <div class="content-column">
                <div class="content-title">
                  <!--                            <img src="/render/asrorz/arbit/img/shield_top.png" alt="">-->
                  <h2><?= Az::l('CPA СЕТЬ') ?></h2>
                  <h3><?= Az::l('С ВЫБРАННЫМИ ') ?><br><?= Az::l('ВЫГОДНЫМИ ПРЕДЛОЖЕНИЯМИ') ?></h3>
                  <p><?= Az::l('Работая на рекламной платформе №1, мы ДЕЛАЕМ то, что не могут сделать другие: предоставлять вам самые выгодные предложения от первоклассных прямых рекламодателей.') ?></p>
<!--                  <a href="/cpas/user/login-register.aspx">--><?//= Az::l('Присоединиться') ?><!--</a>-->
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6" style="padding-top: 5%;">
              <?

              $login = $this->require('/webhtm/cpas/user/blocks/login.php');
              $register = $this->require('/webhtm/cpas/user/blocks/register.php');

              $items = [
                  Az::l('Вход') => $login,
                  Az::l('Регистрация') => $register,
              ];

              $content = [];
              foreach ($items as $key => $value) {
                  $tabItem = new TabItem();
                  $tabItem->label = $key;
                  $tabItem->content = $value;
                  $content[] = $tabItem;
              }

              echo ZTabWidget::widget([
                  'data' => $content,
                  'config' => [
                      'type' => ZTabWidget::type['classic'],
                      'mdTabColor' => ZTabWidget::mdTabColor['black'],
                      'classicTabColor' => ZTabWidget::classicTabColor['tabs-grey'],

                  ],
              ]);
              ?>
          </div>
        </div>
      </div>
    </div>


  </div>

  <!--SIPML5 begin-->


</div>


<script>
    function slowScroll(id) {
        $('html, body').animate({
            scrollTop: $(id).offset().top
        }, 500)
    }

</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
