<?php

use zetsoft\dbitem\core\WebItem;
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

$action->title = Azl . 'Бренды';
$action->icon = 'fa fa-rocket rss';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">




        <div class="row">
            <div class="col-md-12 col-12">














            </div>
        </div>


    </div>

</div>

<script>

    // Then some JavaScript in the browser:
    var wbs = new WebSocket('ws://localhost:9312/core/fop/fop.aspx');


    wbs.onmessage = function(event) {
        console.debug("WebSocket message received:", event);
    };

    wbs.onopen = function(event) {
        console.log("WebSocket is open now.");
        wbs.send('22222222222222');
        console.log(event);
    };


    // Listen for messages
    wbs.addEventListener('message', function (event) {
        console.log('Message from server ', event.data);
    });


    wbs.onerror = function(event) {
        console.error("WebSocket error observed:", event);
    };

    wbs.onclose = function(event) {
        console.log("WebSocket is closed now.");
    };

    var url = wbs.url;

   // wbs.close();





</script>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
