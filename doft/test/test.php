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
    $this->fileCss('/render/asrorz/css/doft.css');

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/doft/navbar/doft_navbar.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();$this->userIdentity()->user_company_id;

    ?>
    <table class="doft-panels">
        <tr>
            <td>
                <span><i class="fas fa-box"></i></span>
            </td>
            <td>
                <a href="#">Find Loads</a>
            </td>
            <td>
                <span><i class="fas fa-truck"></i></span>
            </td>
            <td>
                <a href="#">Post Trucks</a>
            </td>
            <td>
                <span><i class="fas fa-bookmark"></i></span>
            </td>
            <td>
                <a href="#">My Loads</a>
            </td>
            <td>
                <span><i class="fas fa-tools"></i></span>
            </td>
            <td>
                <a href="#">Tools & Services</a>
            </td>
        </tr>
    </table>

</div>



<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
