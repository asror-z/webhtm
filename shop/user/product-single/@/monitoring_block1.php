



    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="row ">

                <div class="col-lg-3">
                    <div class="col-12">
                        <?

                        use zetsoft\widgets\inputes\ZInputWidget;
                        use zetsoft\widgets\themes\ZCardWidget;

                        ZCardWidget::begin([
                            'config' => [
                                'title' => 'Оставить заявку',
                                'hasTitle' => false,
                                'type' => ZCardWidget::type['dynCard'],
                            ]
                        ]);
                       
                        ?>
                        <h3 class="text-center">Средняя цена</h3>
                        <h4 class="text-center">
                            0 сум
                        </h4>
                        <h6 class="text-muted text-center">
                            <?if(!empty($item->min_price) || !empty($item->max_price)){?>
                            <?=$item->min_price; echo $item->currency;?>
                            <?=$item->max_price; echo $item->currency;?>
                            <?}else {?>
                            0 сум - 0 сум
                            <?}?>
                        </h6>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <p class="text-center">Как только цена на товар снизится,
                            вы сразу об этом узнаете</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="mb-3 btn btn-success btn-block">Следить за снижением цены</button>
                    </div>

                </div>
                <?
                ZCardWidget::end();
                ?>
                <div class="col-lg-6">


                        <?
                        echo $this->require( '/webhtm/shop/user/product-single/block/components/amchart-footer.php');
                        ?>


                </div>

                <div class="col-lg-3">

                    <?
                    ZCardWidget::begin([
                        'config' => [
                            'title' => 'Оставить заявку',
                            'hasTitle' => false,
                            'type' => ZCardWidget::type['dynCard'],
                        ]
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <h4>Подскажем когда цена снизится</h4>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <p>Введите свою почту и получайте уведомления об изменении цены</p>

                        <?
                        echo ZInputWidget::widget([
                            'config' => [
                                'class' => 'text-center',
                                'placeholder' => 'market_place@mail.ru'
                            ],
                        ]);
                        ?>

                        <button class="btn btn-success btn-block w-100">Отправить </button>
                        <?
                        ZCardWidget::end();
                        ?>



                    </div>


                </div>

            </div>

        </div>
    </div>


