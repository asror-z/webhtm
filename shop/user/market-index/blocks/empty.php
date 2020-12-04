<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
$action = new WebItem();

$action->title = Azl . 'Описание';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    $this->fileCss('/render/asrorz/css/loader.css');

    $this->head();
    ?>
</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();
require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>
<div class="mt-5">
    <div class="text-center d-block">

        <i class="fas fa-shopping-basket fa-10x text-light"></i>

        <h3 class="mt-5 text-muted">
            <?= Az::l('Ваш список избранных товаров пуст') ?>
        </h3>

       
        <br>

        <?
        echo ZButtonWidget::widget([
            'config' => [
                'text' => 'Перейти к покупкам',
                'color' => ZColor::color['green'],
                'class' => '',
                'url' => '/shop/user/main/main.aspx',
                'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                'btnSize' => ZColor::btnSize['btn-md'],
                'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                'btnRounded' => false,
            ],

        ]);
        ?>
    </div>
</div>
<?php
echo $this->require( '/webhtm/block/SingleProduct/footer.php');
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>
