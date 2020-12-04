<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

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
    $this->fileCss('/render/grapeAssets/styleComponents/responsiveCard.css');

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="cr-body">
    <div class="cr-container">
        <div class="cr-card">
            <div class="cr-imgBx">
                <img src="https://im0-tub-com.yandex.net/i?id=b653ff6d87cfa06304f3cbf716747be8&n=13" alt="photo">
            </div>
            <div class="cr-content">
                <h2>Card One</h2>
                <p>Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Animi consectetur,
                    doloribus eaque esse impedit laborum
                    minima omnis perferendis, possimus quibusdam
                    quos ratione tenetur voluptate.</p>
            </div>
        </div>
    </div>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


