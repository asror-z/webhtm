<?php

use zetsoft\system\Az;
use zetsoft\widgets\cards\ZCartViewWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
?>
<!-- cart icon -->
<div>
    <?php

    $cart = Az::$app->cores->session->get('cart');

    $amount = '';
    if (is_array($cart))
        $amount = count($cart);


    echo ZCartViewWidget::widget([
        'id' => 'cart_total_amount',
        'config' => ['url' => '/shop/user/session-basket/main.aspx',
            'text' => '',
            'class' => 'ZCartIcon wishCount',
            'amount' => $amount
        ]
    ]);
    ?>
</div>

<!-- wish icon -->
<div>
    <?php

    $wishList = Az::$app->cores->session->get('wishList');
    $wishAmount = '';

    if (is_array($wishList))
        $wishAmount = count($wishList);

    echo ZCartViewWidget::widget([
        'id' => 'wish_list',
        'config' => ['url' => '/shop/user/wish/index.aspx',
            'icon' => 'far fa-heart grey-text',
            'text' => '',
            'hint' => 'Избранное',
            'class' => 'ZWishIcon ',
            'amount' => $wishAmount
        ]
    ]);
    ?>
</div>

<!-- compare icon -->
<div>
    <?php

    $compareList = Az::$app->cores->session->get('compare');
    $compareAmount = '';

    if (is_array($compareList))
        $compareAmount = count($compareList);

    echo ZCartViewWidget::widget([
        'id' => 'compare_list',
        'config' => ['url' => '/shop/user/compare/index.aspx',
            'icon' => 'fa fa-chart-bar fa-align-center grey-text',
            'text' => '',
            'hint' => 'Сравнить',
            'class' => 'ZCompareIcon',
            'amount' => $compareAmount
        ]
    ]);
    ?>
</div>

<!-- view icon -->
<div>
    <?php

    $viewList = Az::$app->cores->session->get('viewed');
    $viewAmount = '';

    if (is_array($viewList))
        $viewAmount = count($viewList);

    echo ZCartViewWidget::widget([
        'config' => ['url' => '/shop/user/viewed/index.aspx',
            'icon' => 'fas fa-history grey-text',
            'text' => '',
            'hint' => 'Просмотренные',
            'class' => 'ZViewedIcon',
            'amount' => $viewAmount
        ]
    ]);
    ?>
</div>

<script>

</script>
