<?php

use zetsoft\widgets\inputes\ZKStarRatingWidget; ?>

<div class="col-lg-12 col-md-12 col-sm-12 c-card border p-2">

    <div class="row">

        <div class="col-lg-7 col-md-7 col-sm-7 col-7 c-card-header">

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-header--items">

                <div class="d-flex justify-content-between">

                    <div class="col-lg-5 col-md-5 col-sm-5 col-5 c-card-image h-25">

                        <div class="w-100 h-100">
                            <img src="https://banner2.cleanpng.com/20180330/oue/kisspng-adidas-originals-logo-adidas-superstar-shoe-adidas-5abdfa54790060.6689038315223998284956.jpg" class="img-fluid" alt="">
                        </div>

                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-7 col-7 c-card-header--text">

                        <h5 class="mt-1">Adidas</h5>

                    </div>
                    
                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-events">

                <div class="d-flex">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 c-card-stars p-0 m-0 mt-2">

                        <?
                        echo ZKStarRatingWidget::widget([
                            'name' => 'gggfg',
                            'config' => [
                                'show' => false,
                                'class'=> '',
                                'icon' => '<i class="fas fa-star fp-13"></i>',

                            ]
                        ]);
                        ?>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 c-card-review">
                        <p class="ml-2 mt-2">8 отзыва</p>
                    </div>
                </div>
                
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-paying">

                <p class="text-muted m-0 p-0 fp-14">1200 людей купили этот товар</p>
                <p class="text-dark m-0 p-0 fp-14">Оплата : наличними , картой</p>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 d-flex c-card-footer p-0 mr-0">

                <i class="fad fa-truck-container fp-18 ml-3"></i>
                <p class="text-muted fp-14 ml-2">Бесплатная доставка курером</p>

            </div>

        </div>

        <div class="col-lg-5 col-md-5 col-sm-5 col-5">

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-right">

                <div class="d-flex">

                    <p class="ml-2 mt-1"><del>16.000 сум</del></p>
                    <h6 class="ml-2 mt-1"><span class="badge badge-danger">-9%</span</h6>

                </div>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-right--price">

                <p class="ml-4">10.000 сум</p>

            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 c-card-right--btn">

                <button class="btn btn-sm btn-success">Добавить в корзину</button>

            </div>

        </div>

    </div>

</div>

<style>

    .c-card {
        width: 100%;
        height: 200px;
    }

    .right-button {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        background-color: limegreen;
    }

</style>
