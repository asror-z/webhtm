<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZDilshodBoxWidget;
use zetsoft\widgets\market\ZProductCardWidget;
use zetsoft\widgets\market\ZProductTabsOnlyWidget;

/** @var ZView $this */

$action = new WebItem();
$action->init();
$action->title = Azl . 'Веб-действия';
$action->debug = true;
$action->csrf = false;
$action->type = WebItem::type['html'];
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$sort=$this->httpGet('name');
$cat=$this->httpGet('cat');
$cid= $this->httpGet('idd');
$key= $this->httpGet('key');
$sort=(int)$sort;
if ($sort!=4 && $sort!=3)$sort=4;
echo $sort;

/*echo ZProductTabsOnlyWidget::widget(['model' => Az::$app->market->product->allProducts(),
    'config' => [
        'sort'=>$sort,
        'key'=>$key,
        'pager'=>ZProductTabsOnlyWidget::type['link'],
        'widget' => ZProductCardWidget::class,
        'withFilter' =>true

    ]]);*/?>
<script>
  switch('<?= $cat ?>'){
        case 'asc':
            $('#<?= $cid ?>').data("<?= $key ?>","asc");
            $('#<?= $cid ?> .fa-sort-up').removeClass("fa-sort-up");
            break;
        case 'desc':
            $('#<?= $cid ?>').data("<?= $key ?>","desc");
            $('#<?= $cid ?> .fa-sort-down').removeClass("fa-sort-down");
            break;
        default:
         break;
    }/*
    var sortdata;
    var category;
    $('#sort-price').click(function(){
        switch($(this).data("price")){
            case 'asc':
                sortdata =3;
                category="desc";
                break;
            case 'desc':
                sortdata =4;
                category="asc";
                break;
            default:sortdata=0;  break;
        }
        $.ajax({
            url: '/core/product/sort.aspx',
            type: 'GET',
            data: {
                name: sortdata,
                cat: category
            },
            success: function (data) {
                $('#contento').html(data);
                $.pjax.reload({container: '#contento', timeout: false});

            },
            complete: function (data) {

            },
            error: function (res) {
                console.log(res + 'not sent')
            }
        });



    });*/
</script>








