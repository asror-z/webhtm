<?php


use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\models\shop\ShopCatalog;
use zetsoft\models\user\UserCompany;
use zetsoft\models\shop\ShopElement;
use zetsoft\system\Az;
use zetsoft\widgets\inputes\ZKStarRatingWidget;

if($company === null){
    echo Az::l('Нет Данных');
}
   /** @var CompanyCardItem $item  */
?>

<div class="row">
<?php foreach ($company as $item){ ?>
    <div class="col-md-12 mt-5 d-flex border shadow">
        <div class="col-md-1 mt-2 ">
             <img src="<?=$item->image?>"/>
        </div>
        <div class="col-md-7 mt-2 ">
            <a href="<?=$item->url?>"><h4><?=$item->name?></h4></a>
            <div class="">
                <div class="accordion" id="accordionExample">
<!--                    <a class=" text-left"
                       data-toggle="collapse" data-target="#collapseOne"
                    >Производитель процессора: Samsung, Поддержка 2G: Да, Страна:
                        Индия, Разъем....</a>-->

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                        <div class="">
                           <?=$item->title?>
                        </div>
                    </div>

                </div>

                <div class="d-flex align-items-center">
                    <!--<div><a href="#" class="font-italic fp-15 text-bold">MarketPlace.com</a></div>-->
                    <div class="d-flex ml-3">
                        <?
                        echo ZKStarRatingWidget::widget([
                            'name' => 'gggfg',
                            'config' => [
                                'show' => false,
                                'class' => ''

                            ]
                        ]);
                        ?>
                        <a href="#"><span class="text-muted ml-2">5628 отзивов</span></a>
                    </div>
                </div>

                <span>Гарантия производителя.</span>
            </div>
        </div>

        <div class="col-md-4 pl-5">
            <div class="ml-2">
                <div class="ml-4 px-1 py-3">
                    <div class="d-flex align-items-center">
                        <div class="align-items-center">
                            <del><h6     class="text-muted mb-0">21 990&#8381/шт</h6></del>
                        </div>
                        <div class="align-items-center">
                            <span class="rounded-left badge badge-danger ml-2 ">-9%</span>
                        </div>
                    </div>
                    <h4>20 000 &#8381/шт</h4>
                    <div clas="">
                        <span><i class="fas fa-truck text-muted"></i></span>
                        <span class="text-success">Бесплатно курьером завтра</span>
                    </div>
                    <a href="#"><h6 class="">Все варианты доставки</h6></a>

                    <div class="text-muted"><i class="far fa-credit-card"></i> Картой/Наличными
                    </div>
                    <span class="text-muted">Цвет товара:красный <i
                            class="fas fa-exclamation-triangle"></i></span>

                    <submit type="button" class="btn btn-success btn-sm ">В магазин</submit>
                </div>

                <div class="">

                </div>
            </div>
        </div>

    </div>
</div>

<?php
}
?>
