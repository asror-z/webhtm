<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
$action->icon = 'fa fa-globe';
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

require Root . '/webhtm/block/navbar/mainArbit.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();$this->userIdentity()->user_company_id;

    ?>
    <h1>It is view file</h1>
</div>



<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
