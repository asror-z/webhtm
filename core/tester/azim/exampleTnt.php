<?php

use yii\caching\TagDependency;
use yii\data\ActiveDataProvider;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;

use zetsoft\widgets\former\ZAccardionWidget;
use zetsoft\widgets\former\ZDynaWidgetPop;
use zetsoft\widgets\former\ZExpandableSearchWidgetJ;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\incores\ZFaqAccordionWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZAAccordionWidget;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZAccLayWidget3;
use zetsoft\widgets\navigat\ZAccLayWidgetNew;
use zetsoft\widgets\navigat\ZAccLayWidgetTest;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabWidget;
use zetsoft\service\search\TntSearchService;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'History';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var ZView $this */
$this->beginPage();


// vdd($content);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    echo ZSidebarWidget::widget([]);

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();
?>
<?php


echo ZExpandableSearchWidgetJ::widget();
$res = $this->httpGet('searchInputX') ?? '';
$conn = new TntSearchService();
$conn->name = 'CoreProduct';
$conn->search = $res;
$conn->regularSearch();
?>
<?php if(isset($conn->result[0])):?>
    <table class="table">
        <thead>
        <tr>
            <?php $obj = $conn->result[0] ?>
            <?php foreach ($obj as $key => $val): ?>
                <th><?= $key ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($conn->result as $obj): ?>
            <tr>
                <?php foreach ($obj as $valval): ?>
                    <?php if (is_array($valval)): ?>
                        <td>
                            <?php var_dump($valval) ?>
                        </td>
                    <?php else: ?>
                        <td><?php echo $valval; ?></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else:?>
<?php echo "Not Found!"; ?>
<?php endif;?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
