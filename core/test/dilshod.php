<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Потребности';
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/**
 *
 * Start Page
 */

$modelClassName = $this->bootFullUrl();

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

echo ZMmenuWidget::widget()

?>

<div id="page">

    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();echo ZHInputWidget::widget([
        'id' => 'barcode'
    ])

    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/onscan.js@1.5.2/onscan.js"></script>
<script>
    // Initialize with options
    onScan.attachTo(document, {
        suffixKeyCodes: [13], // enter-key expected at the end of a scan
        reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
        onScan: function(sCode, iQty) { // Alternative to document.addEventListener('scan')
            $('#barcode').val(sCode)
        },
        
    });
    

</script>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
