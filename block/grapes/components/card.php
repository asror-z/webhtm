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
        .badge{
            margin-left:37.5%
         }
    </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="container">
    <div class="row "">
        <div class="col-md-12 bg-light rounded">
            <div class="row">
              <h4 class="ml-4"> Горящие товари</h4><h6 class="ml-2 mt-2"> Самая низкая цена за 30 дней</h6>
            </div>
            <div class="row m-0 p-0">
                 <div class="col-md-2 p-1 ml-2 ">
                <div class="card">
                  <div class="card-img>">
                    <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=8" alt="photo" class="card-img-top img-fluid rounded"">
                  </div>
                </div>
                <span class="badge badge-danger badge-pill">-50%</span>
                <p class="text-center m-1"> 200 000 сум</p>
              </div>
                 <div class="col-md-2 p-1">
                <div class="card">
                  <div class="card-img>">
                    <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=8" alt="photo" class="card-img-top img-fluid rounded"">
                  </div>
                </div>
                <span class="badge badge-danger badge-pill">-50%</span>
                <p class="text-center m-1"> 200 000 сум</p>
              </div>
                 <div class="col-md-2 p-1">
                <div class="card">
                  <div class="card-img>">
                    <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=8" alt="photo" class="card-img-top img-fluid rounded"">
                  </div>
                </div>
                <span class="badge badge-danger badge-pill">-50%</span>
                <p class="text-center m-1"> 200 000 сум</p>
              </div>
                 <div class="col-md-2 p-1">
                <div class="card">
                  <div class="card-img>">
                    <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=8" alt="photo" class="card-img-top img-fluid rounded"">
                  </div>
                </div>
                <span class="badge badge-danger badge-pill">-50%</span>
                <p class="text-center m-1"> 200 000 сум</p>
              </div>
                 <div class="col-md-2 p-1">
                <div class="card">
                  <div class="card-img>">
                    <img src="https://im0-tub-com.yandex.net/i?id=f6347ed216cf5f1456a1e4b397e14187&n=8" alt="photo" class="card-img-top img-fluid rounded"">
                  </div>
                </div>
                <span class="badge badge-danger badge-pill">-50%</span>
                <p class="text-center m-1"> 200 000 сум</p>
              </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>




