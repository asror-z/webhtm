<?php

use yii\debug\Module;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [];

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
require Root . '/webhtm/block/header/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
require Root . '/webhtm/block/navbar/mainAzimjon.php';


?>

<div class="row">
    <div class="col-4">
        <?
        echo ZButtonWidget::widget([
            'config' => [
                'btnStyle' => ZButtonWidget::btnStyle['btn-danger'],
                'btnSize' => ZButtonWidget::btnSize['btn-md'],
                'btnRounded' => true,
                'text' => 'button',
                'cooler' => true,
                'url' => '/core/tester/ajaxify/content.aspx',
                'ic-target' => '.secondRow',
                'hasIcon' => true,
            ]
        ])
        ?>
    </div>
    

    <div class="col-4">
        <button
                class="btn btn-info"
                ic-post-to="/core/tester/ajaxify/sample_3.aspx"
                ic-push-url="true"
                ic-target=".secondRow"
                ic-select-from-response=".select2"
        >main btn
        </button>
    </div>


    <div class="col-4">
        <button
                class="btn btn-info"
                ic-post-to="/core/tester/ajaxify/sample_ajax.aspx"
                ic-push-url="false"
                ic-target=".secondRow"
        >main btn
        </button>
    </div>
    <div class="col-4"></div>
</div>

<div class="row">
    <div class="col-12 secondRow">asdasdasd</div>
</div>
<div class="scripts"></div>


<?php
echo ZFooterAllWidget::widget();
//echo ZJspanelWidget::widget();
?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

