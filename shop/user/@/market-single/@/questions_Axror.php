<?php

use phpDocumentor\Reflection\Types\Object_;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\chat\QuestionItem;
use zetsoft\dbitem\shop\MultiProductItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\shop\PropertyItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\dbitem\data\TabItem;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\ZPjax;
use zetsoft\service\market\Question;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\widgets\cards\ZMiniStoreWidget;
use zetsoft\widgets\former\ZAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKTouchSpinWidget;
use zetsoft\widgets\inputes\ZMImageRadioCompanyWidget;
use zetsoft\widgets\inputes\ZMImageRadioGroupWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\market\ZProductPropertyWidget;
use zetsoft\widgets\market\ZReviewWidget;
use zetsoft\widgets\market\ZZoomWpWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSlimScrollWidget;
use zetsoft\widgets\navigat\ZYandexTabWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\widgets\navigat\ZSmartTabWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Вопросы и ответы';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$company_id = $this->httpGet('id');


if (isset($company_id)) {
    $companyItem = new QuestionItem();

    $companyItem->id = '1';
    $companyItem->question = 'kennyS mn ljbbk';
    $companyItem->answers = 'dfsfsdfjdfdskfjdsfkd ';
    $companyItem->comment = ' Lorem ipsum dolor sit amet';

}


$role = $this->userRole();

if ($role === 'user')
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Задать вопрос'),
            'btnRounded' => false,
            'btnStyle' => 'btn-success',
            'btnSize' => 'btn-sm',
            'class' => 'fp-30 mt-3 px-4 py-2',
            'url' => Zurl::to(['/core/user/user-auth/login-register']),
        ],
    ]);
else
    $button = ZButtonWidget::widget([
        'config' => [
            'text' => Az::l('Задать вопрос'),
            'btnRounded' => false,
            'btnStyle' => 'btn-outline-success',
            'btnSize' => 'btn-sm',
            'class' => 'small py-2 px-4',
        ],
        'event' => [
            'click' =>'function(){$("#form-modal").modal(\'show\')}',
        ]
    ]);


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
require Root . '/webhtm/block/navbar/main.php';
?>
<div id="content" class="container-fluid">
    <?
    echo $this->require( '/render/market/ZYandexSingleProductHeaderWidget/ready/single-company-header.php')
    ?>
    <?php
    echo $this->require( '/webhtm/shop/user/market-single/block/yandexTab.php', [
        'company_id' => $company_id,
        'type' => 'company',
    ]);
    ?>

    <div class="row">
        <div class="col-lg-12 text-center text-muted fp-24 mt-4">

            <?php
            if (isset($company_item) || empty($company_item))
                $company_item = new Object_();

            echo $this->require( '/webhtm/shop/user/market-single/block/question-answer.php', ['company_id' => $company_id ?? 1]);
            ?>

        </div>
        <div class="col-12 mt-4">
            <div class="d-flex justify-content-center fp-30">
                <?php
                if($company_id)
                    echo $button;
                else
                    echo Az::l('Id is required');
                ?>
            </div>
        </div>

    </div>
</div>
<?php

ZModalWidgetRavshan::begin([
    'id' => 'form',
    'config'=>[
    'isFooter' => false,
    'isBtn' => false,
    'title' => Az::l('Написать Отзыв'),
    ],
]);

echo $this->require( '/webhtm/shop/user/item-question/question-new.php',
['type' => 'question','market_id' => $company_id]);



ZModalWidgetRavshan::end();?>

<?php $this->endBody() ?>

</body>
</html>
<div>
    <?=
    $this->require( '/webhtm/block/SingleProduct/footer.php');
    ?>
</div>

<?php $this->endPage() ?>

