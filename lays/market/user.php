<?php

use yii\web\View;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\place\PlaceCountry;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopOrder;


/** @var ZView $this */


/**
 *
 * Action Params
 */

//vdd(date("H:i:s"));
$action = new WebItem();

$action->title = Azl . 'eyuf';
$action->icon = 'fal fa-print';
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
    <style>
        .trending-category ul {
            display: flex;
            position: relative;
            padding: 0;
        }

        .trending-category ul li {
            display: flex;
        }

        .trend {
            margin-right: -55px;
            transition: .5s ease-in-out;
            z-index: 1;
        }

        .trend:hover {
            transition: .4s ease;
            margin-right: 1px;
        }

        .trending-category ul li a {
            display: flex;
            flex-direction: column;
            color: #222;
            text-decoration: none;
        }

        .trending-category .trend-title {
            padding: 10px 0;
            overflow: hidden;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: .2s ease-in-out;
        }

        .trend:hover .trend-title {
            width: 100%;
        }

        .trending-category ul li img {
            width: 150px;
            border-radius: 10px;
            height: 150px;
        }

        .advertisement {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            height: 100%;
            position: relative;
            background: rgba(174, 174, 174, 0.12);
            padding: 1em;
            max-height: 540px;
        }

        .advertisement-title {
            font-size: 42px;
            text-align: center;
        }

        .advertisement-icons {
            position: absolute;
            bottom: 10px;
            cursor: pointer;
            transform: scale(1);
            transition: .2s ease-in-out;
        }

        .advertisement-icons a {
            color: #444;
            opacity: .9;
        }

        .advertisement-icons i {
            font-size: 28px;
            transition: .2s ease-in-out;
        }

        .advertisement-icons i:hover {
            color: #0a5fcf;
        }

        .advertisement-icons:active {
            transform: scale(1.1);
        }
    </style>

</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();
echo ZNProgressWidget::widget([]);
//require Root . '/webhtm/block/navbar/eyuf_navbar.php';

require Root . '/webhtm/block/header/mainM.php';
require Root . '/webhtm/block/navbar/mainCommon.php';
require Root . '/render/menus/ZSidebarWidget/ready/main.php';
?>

<div id="page">


    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?
                echo $this->require($content);
               
                ?>
            </div>
        </div>
    </div>
</div>


<?php
echo ZFooterAllWidgetOrg::widget();
echo ZJspanelWidget::widget([]);
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
