<?

use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\cards\ZProductCardWidget;
use zetsoft\widgets\cards\ZProductTabsOnlyWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */
//todo: bu servis ishlamayapti $wishProducts = Az::$app->market->product->getWishProductItems();
//todo: shunga !empty qoyib qoyildi !!!!


$products = Az::$app->market->session->getWishProductItems();

if (!empty($products)) :?>
    <h4 class="text-green-main my-3 text-center">Список избранных товаров</h4>
    <div class="switch-parent d-flex justify-content-end mr-4 mb-2">
        <a class="btn btn-success rounded mt-0" id="switch_to_col" href="#col">
            <i class="fas fa-th-large"></i>
        </a>
        <a class="btn btn-success rounded mr-2 mt-0" id="switch_to_list" href="#list">
            <i class="fas fa-th-list"></i>
        </a>
    </div>



    <div class="row">
        <?

        foreach($products as $item)

            echo $this->require( '/render/cards/ZListViewWidget/ready/vertical_horizontal_infinity.php',[
            'item'=>$item
       ])
        ?>
    </div>


<? else :?>
    <div class="mt-5">
        <div class="text-center d-block">

            <i class="far fa-heart fa-10x text-light"></i>

            <h3 class="mt-5 text-muted">
                <?= Az::l('Ваш список избранных товаров пуст') ?>
            </h3>

            <p class="text-muted">
                <?= Az::l('Добавьте товары в избранное, чтобы понравившиеся товары были всегда под рукой.') ?>
            </p>
            <br>

            <?
            echo ZButtonWidget::widget([
                'config' => [
                    'text' => 'Перейти к покупкам',
                    'color' => ZColor::color['green'],
                    'class' => '',
                    'url' => '/shop/user/main-common/main.aspx',
                    'btnStyle' => ZButtonWidget::btnStyle['btn-success'],
                    'btnSize' => ZColor::btnSize['btn-md'],
                    'btnFontSize' => ZButtonWidget::btnScale['0.5'],
                    'btnRounded' => false,
                ],

            ]); ?>

        </div>

    </div>
<? endif; ?>
