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
                        <h3 class="text-left font-weight-normal"><?php echo Az::l('Коротко о товаре'); ?></h3>
                        <ul class="pl-4 mb-0 fe-08">
                            <?
                            $count=0;
                            foreach (array_slice($productProperty, 0, 5) as $key => $value){
                            ?>
                                <li class="font-weight-light"><?= $value->name . ' - ';
                                    foreach ($value->items as $_key => $_value) {
                                        $count++;
                                        if ($count===1){
                                            echo $_value;
                                        }
                                    }
                                    $count=0 ?></li>
                            <?} ?>
                        </ul>
                        <div class="mt-3">
                            <a href="#tab-2">Все характеристики</a>
                        </div>
                        <div class="mt-1">
                            <a href="#tab-5">Задать вопрос о товаре</a>
                        </div>
                        <div>
                            <a href="<?$product->categoryUrl?>">Все товары <span class="font-weight-bold"><?=$product->brand?></span> </a>
                        </div>
                            <a href="<?=$product->categoryUrl?>">
                                <div style='height: 50px; background-image: url("<?= $product->brandImage ?>"); background-size: contain; background-repeat: no-repeat' class="brand-image"></div>
                            </a>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="card-text">
                                <?= Az::l($product->title) ?>
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
