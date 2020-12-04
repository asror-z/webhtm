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
    $this->fileCss('/render/grapeAssets/flipCard/styleFlipCard.css');




    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<!-- flip-card-container -->
<div class="flip-card-container" style="--hue: 220">
    <div class="flip-card">

        <div class="card-front">
            <figure>
                <div class="img-bg"></div>
                <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Flip card Caption">
                <figcaption>Flip card Caption</figcaption>
            </figure>

            <ul>
                <li>Detail 1</li>
                <li>Detail 2</li>
                <li>Detail 3</li>
                <li>Detail 4</li>
                <li>Detail 5</li>
            </ul>
        </div>

        <div class="card-back">
            <figure>
                <div class="img-bg"></div>
                <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" alt="Brohm Lake">
            </figure>

            <button>Book</button>

            <div class="design-container">
                <span class="design design--1"></span>
                <span class="design design--2"></span>
                <span class="design design--3"></span>
                <span class="design design--4"></span>
                <span class="design design--5"></span>
                <span class="design design--6"></span>
                <span class="design design--7"></span>
                <span class="design design--8"></span>
            </div>
        </div>

    </div>
</div>
<!-- /flip-card-container -->






<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


