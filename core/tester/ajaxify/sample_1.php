<?php

use yii\debug\Module;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZArrayWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZIconPickerWidget;
use zetsoft\widgets\inputes\ZInputWidget;
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
    <div class="col-5">
    </div>
    <div class="col-4">
        <?
        echo ZButtonWidget::widget([
            'config' => [
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-warning'],
                'btnSize' => ZButtonWidget::btnSize['btn-md'],
                'btnRounded' => false,
                'text' => 'Кнопка',
                'title' => 'Кнопка',
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => true,
                'iconsSm' => false,
                'url' => '/core/tester/ajaxify/sample_2.aspx',
                'cooler' => true,
                'icon' => 'ic-indicator fa fa-spinner fa-spin',
                'ic-target' => '.row .col-5'
            ],
        ]);

        ?>
    </div>
    <div class="col-3">
        <?

        echo ZButtonWidget::widget([
            'config' => [
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-warning'],
                'btnSize' => ZButtonWidget::btnSize['btn-md'],
                'btnRounded' => false,
                'text' => 'Кнопка',
                'title' => 'Кнопка',
                'toggle' => ZButtonWidget::toggle['tooltip'],
                'hasIcon' => true,
                'iconsSm' => false,
                'url' => '/core/tester/ajaxify/sample_3.aspx',
                'cooler' => true,
                'icon' => 'ic-indicator fa fa-spinner fa-spin',
                'ic-target' => '.row .col-3'
            ],
        ]);

        ?>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>

