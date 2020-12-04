<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
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
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/test.php';

?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-4 media-category">
           
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="row">
                <div class="col-md-12 p-gfh">
                  <!--  --><?php
/*                    echo ZMSwiperWidget::widget([
                        'data' => [
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46657_234607.png',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/04/22/46006_145036.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46637_233144.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/19/46645_233631.jpg',
                            'https://gcdn.utkonos.ru/resample/940x300q95/images/banner/2020/05/07/44049_133221.jpg',
                        ],
                        'config' => [
                            'slidesPerView' => 1,
                            'height' => '50vh',
                            'class' => 'p-gfh',
                            'mousewheel' => false,
                            'slidesMediaPerView640' => 1,
                            'slidesMediaPerView500' => 1,
                            'slidesMediaPerView1024' => 1,
                            'slidesMediaPerView325' => 1,
                        ],
                    ]);
                    */?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 p-0">
        <div class="row">
            <div class="col-12 pt-2">



            </div>
            <div class="col-12 pt-2">

          

            </div>
        </div>
    </div>
    <div class="col-md-12 ">
        <h2 class="mt-4 mb-4  text-green-main text-center">Любимые бренды</h2>
        
     
    </div>

</div>

<?php
echo ZFooterAllWidget::widget();
//echo ZJspanelWidget::widget();
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
