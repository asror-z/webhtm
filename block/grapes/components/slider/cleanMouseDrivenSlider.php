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
    $this->fileCss('/render/grapeAssets/slider/MouseDrivenSlider/styleMouseDrivenSlider.css');
    

    
    $this->fileJs('/render/grapeAssets/slider/MouseDrivenSlider/jsMouseDrivenSlider.js');




    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div class="mds-container position-relative w-75">
    <div id="wrap">
        <a href="#" class="hb">
            <div class="c">
                <img src="https://source.unsplash.com/user/web_tiki/2000x1300" alt=""/>
                <div class="txt">
                    <h1>Title here</h1>
                    <p>Some longer text here thats wide enough to span on several lines.</p>
                </div>
            </div>
        </a>
        <div class="fullBg">
            <img src="https://source.unsplash.com/user/web_tiki/2000x1300" alt=""/>
        </div>
        <a href="#" class="hb">
            <div class="c">
                <img src="https://source.unsplash.com/user/web_tiki/2000x1301" alt=""/>
                <div class="txt">
                    <h1>Title here</h1>
                    <p>Some longer text here thats wide enough to span on several lines.</p>
                </div>
            </div>
        </a>
        <div class="fullBg">
            <img src="https://source.unsplash.com/user/web_tiki/2000x1301" alt=""/>
        </div>
        <a href="#" class="hb">
            <div class="c">
                <img src="https://source.unsplash.com/user/web_tiki/2000x1302" alt=""/>
                <div class="txt">
                    <h1>Title here</h1>
                    <p>Some longer text here thats wide enough to span on several lines.</p>
                </div>
            </div>
        </a>
        <div class="fullBg">
            <img src="https://source.unsplash.com/user/web_tiki/2000x1302" alt=""/>
        </div>
        <a href="#" class="hb">
            <div class="c">
                <img src="https://source.unsplash.com/user/web_tiki/2000x1303" alt=""/>
                <div class="txt">
                    <h1>Title here</h1>
                    <p>Some longer text here thats wide enough to span on several lines.</p>
                </div>
            </div>
        </a>
        <div class="fullBg">
            <img src="https://source.unsplash.com/user/web_tiki/2000x1303" alt=""/>
        </div>
    </div>
</div>
<div>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi beatae culpa cupiditate, dignissimos dolore doloribus, eaque eos fuga fugit id illo nihil numquam perferendis quis reiciendis, sunt tempora veritatis voluptatem?
    
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



