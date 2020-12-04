<?php

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\system\Az;

?>
<div class="row py-5">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="row ">
            <div class="col-md-6 col-xl-6 col-sm-12 ">
                <div class="d-flex justify-content-center">
                    <?/*= $this->require('/blocks/SingleProduct/imageZoom.php', ['product'=>$product]) */?>
                    <?= $this->require( '/render/cards/ZZoomWidget/ready/zoom.php') ?>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 col-sm-12">
                <div class="row px-3">
                    <div class="col-md-12">
                        <h3><?= Az::l('Свойства продукта')?></h3>
                    </div>
                    <div class="col-md-12">

                        <?
                             echo  $this->require('/blocks/SingleProduct/properties.php',['product' => $product]);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="row mb-2">
            <div class="col-md-6 col-xl-6 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-uppercase text-left font-weight-bold fp-18"><?php echo Az::l('Коротко о товаре'); ?></h6>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="card-text">
                                <?= $product->title ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                        <div class="d-flex">
                            <div>
                                  <h4><?= $product->brand ?></h4>
                            </div>
                            <div class="img-fluid">
                                <img src="">

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-6 col-sm-12 px-2">
                <div class="d-flex justify-content-center flex-column">
                    <h1 class="bold fp-30 text-center"> <?= Azl.'Цены в магазинах' ?></h1>
                </div>
                <div class="d-flex justify-content-center flex-column" id="market_list">
                </div>
                <div class="d-flex justify-content-center align-items-center " >

                    <?
                        echo $this->require( '/webhtm/block/SingleProduct/slim.php', ['product'=>$product]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
