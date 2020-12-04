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
    $this->fileCss('/render/asrorz/mdb/css/addons-pro/steppers.css');
    $this->fileJs('/render/asrorz/mdb/js/addons-pro/steppers.js');

    ?>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <style>
      ul.horizontal-fix li a {
          padding: .84rem 2.14rem;
      }
      .step-new-content::-webkit-scrollbar{
          display: none;
      }
      .step .step-new-content .step-ul {
          background: #fff;
          padding: 0;
          box-shadow: 1px 0px 10px rgba(255, 252, 252, 0.1);
          border-radius: 5px;
      }
      .step .step-new-content .step-ul .step-li {
          list-style: none;
          display: flex;
          justify-content: space-between;
      }
      .step .step-new-content .step-ul .step-li a {
          list-style: none;
          display: flex;
          justify-content: space-between;
          color: #555;
          width: 100%;
          padding: .5em 1em;
          align-items: center;
          text-transform: uppercase;
          font-size: 15px;
          border-bottom: 1px solid rgba(0, 0, 0, .1);
          transition: .1s ease-in-out;
      }
      .step .step-new-content .step-ul .step-li a i {
          transition: .1s ease-in-out;
          transform: translateX(-12px);
          opacity: 0;
      }
      .step .step-new-content .step-ul .step-li a:focus i{
          transform: translateX(0);
          opacity: 1;
      }
      .step .step-new-content .step-ul .step-li a:focus {
          background: #f1f1f1;
      }
      .step .step-new-content .step-ul .step-li a:hover {
          background: #f1f1f1;
      }
  </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container-fluid pt-4">

  <ul class="stepper horizontal horizontal-fix" id="horizontal-stepper-fix">

    <li class="step active">
      <div class="step-title waves-effect waves-dark">Step 1</div>
      <div class="step-new-content mt-3">
        <div class="row">
          <div class="col-2">
            <ul class="step-ul">
              <li class="step-li"><a href="#">all
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">popular
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">education
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">blog
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">business
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">personal
                  <i class="fas fa-chevron-right"></i>
                </a></li>
              <li class="step-li"><a href="#">ecommerce
                  <i class="fas fa-chevron-right"></i>
                </a></li>
            </ul>
          </div>
          <div class="row col-10">

            <div class="view overlay zoom">
              <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/6-col/img%20(131).jpg" class="img-fluid " alt="zoom">
              <div class="mask flex-center waves-effect waves-light">
                <p class="white-text">Zoom effect</p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </li>
    <li class="step">
      <div class="step-title waves-effect waves-dark">Step 2</div>
      <div class="step-new-content">
        <div class="row">
          <div class="md-form col-12 ml-auto">
            <input id="password-horizontal-fix" type="password" class="validate form-control" required>
            <label for="password-horizontal-fix">Your password</label>
          </div>
        </div>
        <div class="step-actions">
          <button class="waves-effect waves-dark btn btn-sm btn-primary next-step" data-feedback="someFunction22">CONTINUE</button>
          <button class="waves-effect waves-dark btn btn-sm btn-secondary previous-step">BACK</button>
        </div>
      </div>
    </li>

    <li class="step">
      <div class="step-title waves-effect waves-dark">Step 3</div>
      <div class="step-new-content">
        Finish!
        <div class="step-actions">
          <button class="waves-effect waves-dark btn-sm btn btn-primary m-0 mt-4" type="button">SUBMIT</button>
        </div>
      </div>
    </li>

    <li class="step">

      <div class="step-title waves-effect waves-dark">Step 4</div>
      <div class="step-new-content">
        Hello world 4
        <div class="step-actions">
          <button class="waves-effect waves-dark btn-sm btn btn-primary m-0 mt-4" type="button">SUBMIT</button>
        </div>
      </div>
    </li>

  </ul>

</div>

<?php $this->endBody() ?>

<script>
    $(document).ready(function () {
        $('.stepper').mdbStepper();
    })

    function someFunction22() {
            $('#horizontal-stepper-fix').nextStep();
    }
</script>

</body>
</html>

<?php $this->endPage() ?>


