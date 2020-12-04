<?
/**@var \zetsoft\system\kernels\ZView $this*/

$product = \zetsoft\system\Az::$app->market->product->getproducttestsingle();

?>

                <div class="card-title">
                    <? $this->pjaxBegin(); ?>
                    <?
                    if (isset($companyId))

                        echo ZBreadcrumbsWidget::widget([
                            'config' => [
                                'mainUrl' => '/shop/user/product/single-productAzizjonSherzod2.php',
                                'mode' => ZBreadcrumbsWidget::mode['category'],
                                'category_id' => $companyId,
                            ]
                        ])
                    ?>
                    <div class="d-flex justify-content-between">
                        <h3 class="ml-3"><?= $product->name ?></h3>
                        <h3><? if($product->currencyType == 'before'){
                            echo $product->currency;
                        } echo $product->new_price;
                        if($product->currencyType == 'after'){
                            echo $product->currency;
                        }?></h3>
                    </div>
                    <div class="row ml-0">
                        <div class="col-md-12 bg-white py-2">
                            <?php
                            echo $this->require( '/webhtm/block/SingleProduct/stars.php', ['product' => $product]);
                            ?>
                        </div>
                    </div>
                    <?
                    $this->pjaxEnd();
                    ?>

                </div>

