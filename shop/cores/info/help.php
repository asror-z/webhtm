
<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageBlocks;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Помощь';
$action->icon = 'fa fa-industry';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();



/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?
    require Root . '/webhtm/block/header/mainM.php';
    require Root . '/webhtm/block/navbar/main.php';
    require Root . '/render/menus/ZSidebarWidget/ready/main.php';

    echo ZSessionGrowlWidget::widget();?>

  <div id="content" class="content-footer p-3">

      <div class="row support">
          <div class="col-lg-4" id="up">
              <div id="list-example" class="list-group sticky-top">
                  <a id="1" class="list-group-item list-group-item-action py-3" href="#list-item-1"> 1. Почему у меня не получается купить товар, который я купил ранее?</a>
                  <a id="2" class="list-group-item list-group-item-action py-3" href="#list-item-2">2. Где можно посмотреть характеристики товара?</a>
                  <a id="3" class="list-group-item list-group-item-action py-3" href="#list-item-3">3. Нужно ли платить за доставку товара в выбранный мной «pick-up point»?</a>
                  <a id="4" class="list-group-item list-group-item-action py-3" href="#list-item-4">4. Почему у меня не получается купить товар, который я купил ранее?</a>
                  <a id="5" class="list-group-item list-group-item-action py-3" href="#list-item-5">5. Нужно ли платить за доставку товара в выбранный мной «pick-up point»?</a>
              </div>
          </div>
          <div class="col-lg-8">
              <h2>Помощь и часто задаваемые вопросы</h2>
              <div data-offset="1" class="list-group" data-target="#list-example">
           <!--   <div  style="margin-bottom: 80px"></div>-->
                  <h4  id="list-item-1" class="text-success">Почему у меня не получается купить товар, который я купил ранее?
                  </h4>
                  <p>В случае если Вы передумали Вы можете отказаться от товара до получения товара или после получения в течении 24 часов (упаковка или пломба товара должна быть целой), то все Ваши средства, потраченные на покупку товара попадут Вам на банковскую карту (независимо от формы оплаты во время покупки, Вы получите свои деньги на банковскую карту). Срок получения денег займет от 5 до 10 банковских дней. Примечание! В случае отсутствия банковской карты, Вы можете открыть карту и преподнести нам расчетный счет для получения денег.</p>
                  <hr style="background: lightgrey; width:100%;">
                  <h4 id="list-item-2" class="text-success">Где можно посмотреть характеристики товара?</h4>
                  <p>В случае если Вы передумали Вы можете отказаться от товара до получения товара или после получения в течении 24 часов (упаковка или пломба товара должна быть целой), то все Ваши средства, потраченные на покупку товара попадут Вам на банковскую карту (независимо от формы оплаты во время покупки, Вы получите свои деньги на банковскую карту). Срок получения денег займет от 5 до 10 банковских дней. Примечание! В случае отсутствия банковской карты, Вы можете открыть карту и преподнести нам расчетный счет для получения денег.</p>
                  <hr style="background: lightgrey; width:100%;">
                  <h4 id="list-item-3" class="text-success">Нужно ли платить за доставку товара в выбранный мной «pick-up point»?</h4>
                  <p>В случае если Вы передумали Вы можете отказаться от товара до получения товара или после получения в течении 24 часов (упаковка или пломба товара должна быть целой), то все Ваши средства, потраченные на покупку товара попадут Вам на банковскую карту (независимо от формы оплаты во время покупки, Вы получите свои деньги на банковскую карту). Срок получения денег займет от 5 до 10 банковских дней. Примечание! В случае отсутствия банковской карты, Вы можете открыть карту и преподнести нам расчетный счет для получения денег.</p>
                  <hr style="background: lightgrey; width:100%;">
                  <h4 id="list-item-4" class="text-success">Почему у меня не получается купить товар, который я купил ранее?</h4>
                  <p>В случае если Вы передумали Вы можете отказаться от товара до получения товара или после получения в течении 24 часов (упаковка или пломба товара должна быть целой), то все Ваши средства, потраченные на покупку товара попадут Вам на банковскую карту (независимо от формы оплаты во время покупки, Вы получите свои деньги на банковскую карту). Срок получения денег займет от 5 до 10 банковских дней. Примечание! В случае отсутствия банковской карты, Вы можете открыть карту и преподнести нам расчетный счет для получения денег..</p>
                  <hr style="background: lightgrey; width:100%;">
                  <h4 id="list-item-5" class="text-success">Почему у меня не получается купить товар, который я купил ранее?</h4>
                  <p>В случае если Вы передумали Вы можете отказаться от товара до получения товара или после получения в течении 24 часов (упаковка или пломба товара должна быть целой), то все Ваши средства, потраченные на покупку товара попадут Вам на банковскую карту (независимо от формы оплаты во время покупки, Вы получите свои деньги на банковскую карту). Срок получения денег займет от 5 до 10 банковских дней. Примечание! В случае отсутствия банковской карты, Вы можете открыть карту и преподнести нам расчетный счет для получения денег.</p>

              </div>
          </div>

      </div>
          </div>
</div>


<script>
    

    $( document ).ready(function() {
        $("#super_navbar").removeClass('sticky-top');
    });
        
    $('.list-group-item').on('click', function () {
        var attrId = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(attrId).offset().top
        }, 800);
    })

    $("#list-example > a").click(function () {
        $("a").removeClass('bg-light')
        $(this).addClass('bg-light')
    })
</script>


<? echo ZFooterAllWidgetOrg::widget()?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
