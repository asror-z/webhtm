<?
    /*echo \zetsoft\widgets\inptest\ZFilepondWidget2::widget();*/

    /*echo \zetsoft\widgets\inptest\ZFilepondWidget2::widget();*/

//echo Root;
// D:\Develop\Projects\ALL\asrorz\zetsoft\upload\uploaz\process
use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\Az;
use zetsoft\widgets\market\ZMenuWidgetUmidB;
use zetsoft\widgets\navigat\ZButtonWidget; ?>

<section class="menu">
    <div class="container">
        <div class="row">

            <!--ZMenuWidgetStart-->
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <?
                        echo ZMenuWidgetUmidB::widget([
                            'name' => '123',
                            'config' => [
                                'open' => false,
                                'name' => "Категории",
                            ],
                        ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


