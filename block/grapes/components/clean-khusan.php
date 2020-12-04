<?php

use yii\widgets\Pjax;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopProduct;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZKRangeWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\MenuItemWidget;
use zetsoft\widgets\menus\ZMetisMenuWidget;
use zetsoft\widgets\market\ZMenuWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;



/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Категория';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;





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

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/main.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';


?>


<?
$this->fileJs('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js');
$this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js');
?>

<div class="container-fluid bg-white">

    <div class="row py-3">

        <button type="button" class="btn btn-light quick-look">Быстрий просмотр</button>

        <script>
            $('.quick-look').on("click",  function (event) {
                bootbox.dialog({
                    title: 'Быстрий просмотр',
                    message: '<iframe src="/render/market/ZBootboxWidget/block/bootboxContent.php" frameborder="0" width="100%" allowtransparency="true"></iframe>',
                    size: 'large',
                    onEscape: true,
                    backdrop: true,
                    centerVertical: true,
                    buttons: {
                        fee: {
                            label: 'Fee',
                            className: 'btn-primary',
                            callback: function(){

                            }
                        },
                        fi: {
                            label: 'Fi',
                            className: 'btn-info',
                            callback: function(){

                            }
                        },
                        fo: {
                            label: 'Fo',
                            className: 'btn-success',
                            callback: function(){

                            }
                        },
                        fum: {
                            label: 'Fum',
                            className: 'btn-danger',
                            callback: function(){

                            }
                        }
                    }
                })
            });
        </script>

    </div>

</div>






<div class="mt-4">
    <?= ZFooterAllWidgetOrg::widget(); ?>
</div>
<?php $this->endBody() ?>
<?/*=
$this->require( '/webhtm/block/SingleProduct/footer.php');
*/?>

</body>
</html>

<?php
$this->endPage()
?>
