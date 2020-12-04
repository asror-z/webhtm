<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */


/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\chates\ZRatChatWidget2;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inptest\ZKSelect2AjaxWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-envelope';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
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

$this->beginBody();?>

<?

echo ZRatChatWidget2::widget()

?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
