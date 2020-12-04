<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\menus\MenuItemWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Продукты по категориям';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];


/*$search = $this->httpGet('search');
if($search !== null or !empty($search)){
Az::$app->search->tntSearchService->model = "zetsoft\\models\\shop\\ShopElement";
Az::$app->search->tntSearchService->name = "ShopElement";
Az::$app->search->tntSearchService->search = $search;
$res = Az::$app->search->tntSearchService->regularSearch();
}*/


$this->paramSet(paramAction, $action);

$this->title();

$this->toolbar();


/** @var ZView $this */
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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>


<div class="container-fluid bg-white">
    <div class="row py-3">
        <div class="col-3">
            <div class="row mx-1">

                <div class="col-12">
                    <br>
                    <?php
                    // echo ZExpandableSearchWidgetJXolmat::widget([]);
                    echo ZMCheckboxWidget::widget([]);
                    /*echo \zetsoft\widgets\former\ZExpandableSearchWidgetJXolmatLevon::widget([]);*/
                    ?>
                </div>
                <a id="disableanchor">
                    <button id="buttononclickdisable" disabled="disabled" class="btn btn-success">asd</button>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        console.log('Ready')
        $('input:checkbox').change(function(){
            if(this.checked){
                console.log('checked');
                $('#buttononclickdisable').removeAttr('disabled')
            }
            else {
                $('#buttononclickdisable').attr('disabled','disabled')
                console.log('not checked')
            }
        });

    })

</script>
<?php


?>
<?php $this->endBody() ?>
<?=
$this->require( '/webhtm/block/SingleProduct/footer.php');
?>
</body>
</html>

<?php
$this->endPage()
?>
