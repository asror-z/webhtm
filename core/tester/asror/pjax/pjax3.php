<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageAction;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Веб-действия';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


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


    echo ZSessionGrowlWidget::widget(); ?>

    <div>


        <div class="row">
            <div class="col-md-12 col-12">

                <div class="mainapp">


                    <?
                    //   Az::$app->params[paramsAction] = $action;
                    $pjax = new ZPjax();
                    $pjax->id = 'pjaxs';

                    $this->pjaxBegin($pjax);

                    echo date("Y-m-d H:i:s");


                    echo ZButtonWidget::widget([
                        'config' => [
                            'title' => 'Ссылка',
                            'icon' => 'fas fa-external-link-alt',
                            'pjax' => 1,
                            'url' => '',
                            'btnRounded' => false,
                            'btn' => false,
                            'hasIcon' => true,
                        ],
                        'active' => [
                            'click' => true,
                            'mousedown' => true,
                            /*
                                'mouseup' => true,
                                'mouseover' => true,
                                'mousemove' => true,
                                'mouseout' => true,
                                'dragstart' => true,
                            */
                        ],
                        'event' => [
                            'click' => <<<JS
function(event){
console.log('ZButtonWidget | click')
// alert ('click');
 
 $.pjax({
    container: "#pjaxs",
    dataType: "html"  ,
    ieRedirectCompatibility: true,
    maxCacheLength: 20,
    push: true         ,
    pushRedirect: false  ,
    replace: false        ,
    replaceRedirect: true  ,
    scrollOffset: 0         ,
    scrollTo: null,
    skipOuterContainers: false,
    target: 'a',
    timeout: 1000,
    type: "POST"  ,
    url: "http://market.zoft.uz/core/tester/asror/pjax2.aspx"
     });
}



JS,
                            'mousemove' => <<<JS
function(event){
console.log('mousemove MY')
}

JS,
                            'mouseout' => <<<JS
function(event){
console.log('mouseout MY')
}

JS,
                        ],
                    ]);


                ?>
                    <br/><br/>
                <?

                    echo ZButtonWidget::widget([
                        'id' => 'asror',
                        'config' => [
                            'title' => 'Ссылка',
                            'icon' => 'fas fa-external-link-alt',
                            'pjax' => 1,
                            'url' => '/core/tester/asror/pjax2.aspx',
                            'btnRounded' => false,
                            'btn' => true,
                            'hasIcon' => true,
                        ],
                        'active' => [
                            'click' => false,
                            'mousedown' => true,
                            'mouseup' => true,
                            'mouseover' => true,
                            'mousemove' => true,
                            'mouseout' => true,
                            'dragstart' => true,
                        ],
                        'event' => [
                            'click' => <<<JS
function(event){

console.log('ZButtonWidget | click22');

    
  /*  $.pjax.reload({url: url, 
        container: '#mainapps',
        async:false ,
        push:true,
        replace    : false,
        timeout    : 10000,
    });*/
  
 // $.pjax.reload({url: url, container: '#ssss'});

       /*        $.pjax.reload({
                    container: '#ssss', 
                    async:true,
                          push       : true,
        replace    : false,
        timeout    : 10000,
        "scrollTo" : false,
                    url: '/core/tester/asror/pjax2.aspx',
               });
               */
}

JS,
                            'mousemove' => <<<JS
function(event){
console.log('mousemove MY')
}

JS,
                            'mouseout' => <<<JS
function(event){
console.log('mouseout MY')
}

JS,
                        ],
                    ]);
       


                    $this->pjaxEnd();


                    ?>

                </div>
            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
