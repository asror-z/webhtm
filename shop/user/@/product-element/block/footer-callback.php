<?php




use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\themes\ZCardWidget;


?>
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12" style="height: 300px">

        <div class="d-flex flex-wrap">

            <div class="col-lg-3 col-md-3 col-sm-12">

                <h2>Средная цена</h2>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h4>14.000 сум</h4>
                    <h4>20.000 - 15.000 сум</h4>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>Как только цена на товара снизится вы узнаете первими</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <button class="btn btn-success btn-block">Следить за ценами</button>
                </div>

            </div>



            <div class="col-lg-3 col-md-3 col-sm-12">

                <div class="col-lg-12 col-md-12 col-sm-12">

                    <?
                    ZCardWidget::begin([
                        'config' => [
                            'title' => 'Оставить заявку',
                            'hasTitle' => false,
                            'type' => ZCardWidget::type['dynCard'],
                        ]
                    ]);
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                          <h2>Подскажем когда цена снизится</h2>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                         <p>Введите свой mail чтобы мы смогли сообшит вам о снизе цены</p>
                    </div>
                    <?
                        echo ZInputWidget::widget([
                            'config' => [
                            'class' => 'text-center',
                            'placeholder' => 'abl_maladoy@mail.ru'
                            ],
                        ]);
                    ?>

                    <button class="btn btn-success btn-block w-100">Отправить заявку</button>
                    <?
                    ZCardWidget::end();
                    ?>


                </div>

            </div>

        </div>

    </div>
    </div>

</div>









