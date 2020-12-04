<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\cards\ZCartViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use function Symfony\Component\String\s;
/**
 * @author: AzimjonToirov
 * Bunda cart wish compare view la turadi. Narsa qoshilganda pjaxda refresh boladi badge qoshiladi
 */
?>
<!-- cart icon -->

<?php
$pjax = new ZPjax();
$pjax->class = 'd-flex';
$this->pjaxBegin($pjax);

echo ZButtonWidget::widget([
    'config' => [
        'url' => '',
        'hasIcon' => true,
        'btnType' => ZButtonWidget::btnType['link'],
        'btnStyle' => ZButtonWidget::btnStyle['none'],
        'btnRounded' => false,
        'text' => 'hozir',
        'pjax' => true,
        'hidden' => true,
        'title' => 'Обновление',
        'ttSize' => ZButtonWidget::ttSize['small'],
        'ttSide' => ZButtonWidget::ttSide['bottom'],
        'btn' => false,
        'class' => 'h-100 p-0 noHover',
        'iconColor' => 'white',
        'icon' => 'fp-10 fa fa-' . FA::_SYNC,
    ],
    'id' => 'refreshMessage',
]);
/** @var ZView $this */
$cart = Az::$app->cores->session->get('cart');

$amount = 0;
if (is_array($cart))
    $amount = count($cart);

echo ZCartViewWidget::widget([
    'id' => 'cart_total_amount',
    'config' => [
        'url' => '/shop/user/session-basket/main.aspx',
        'text' => '',
        'icon' => 'fal fa-shopping-cart text-muted fp-25',
        'class' => 'ZCartIcon wishCount',
        'amount' => $amount
    ]
]);
?>


<!-- wish icon -->
<!--<div>
    <?php
/*
    $wishList = Az::$app->cores->session->get('wishList');
    $wishAmount = 0;

    if (is_array($wishList))
        $wishAmount = count($wishList);

    echo ZCartViewWidget::widget([
        'id' => 'wish_list',
        'config' => ['url' => '/shop/user/session-wish/main.aspx',
            'icon' => 'fal fa-heart grey-text fp-23',
            'text' => '',
            'hint' => 'Избранное',
            'class' => 'ZWishIcon',
            'amount' => $wishAmount
        ]
    ]);
    */?>
</div-->

<!-- compare icon -->
<div>
    <?php
/*
    $compareList = Az::$app->cores->session->get('compare');
    $compareAmount = 0;

    if (is_array($compareList))
        $compareAmount = count($compareList);

    echo ZCartViewWidget::widget([
        'id' => 'compare_list',
        'config' => ['url' => '/shop/user/session-compare/main.aspx',
            'icon' => 'fal fa-chart-bar grey-text fp-23',
            'text' => '',
            'hint' => 'Сравнить',
            'class' => 'ZCompareIcon',
            'amount' => $compareAmount
        ]
    ]);
    */?>
</div>
<img src="" loading="lazy">
<!-- view icon -->
<div>
    <?php
/*
    $viewList = Az::$app->cores->session->get('viewed');
    $viewAmount = 0;

    if (is_array($viewList))
        $viewAmount = count($viewList);

    echo ZCartViewWidget::widget([
        'config' => [
            'url' => '/shop/user/session-viewed/main.aspx',
            'icon' => 'fal fa-history grey-text fp-23',
            'text' => '',
            'hint' => 'Просмотренные',
            'class' => 'ZViewedIcon',
            'amount' => $viewAmount
        ]
    ]);
    */?>
</div>

<?php $this->pjaxEnd(); ?>
