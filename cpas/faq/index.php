<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\faqs\FaqsType;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Faq';
$action->icon = 'fa fa-laptop';
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php
$this->beginBody();


$role = $this->userRole();
$program_ids = FaqsType::find()->all();
$faqs = Faqs::find()->all();


$check = 0;

/** @var Faqs $faqs */

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?


    echo $this->require( '\webhtm\cpas\blocks\header.php');


    ?>
<div class="container-fluid">
    <div class="p-1 bg-white small mx-1 p-3 text-uppercase">
        <h2 class="text-muted">FAQ</h2>
        <a href="/cpas/client/statistic.aspx" class="text-dark"><?= Az::l('Главная')?></a><span> <strong>/</strong>  <?= Az::l('FAQ')?></span>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => Az::l('Часто задаваемые вопросы'),
                    'type' => ZCardWidget::type['dynCard'],
                    'hasTitle' => false,
                    'classBorderColor' => 'bg-light',
                    'classBgColor' => 'bg-light',

                ]
            ]);

            /** @var Faqs $faq */
            foreach ($program_ids as $program_id) {
                foreach ($faqs as $faq) {
                    if ($faq->faqs_type_id == $program_id->id) {
                        if ($check != $faq->faqs_type_id) {
                            echo '<h5 class="text-center">' . $program_id->name . '</h5>';
                            $check = $faq->faqs_type_id;
                        }

                        /** @var ZView $this */
                        echo ZMarketDropdownWidget::widget([
                            'config' => [
                                'content' => Az::l($faq->text),
                                'title' => Az::l($faq->name),
                            ],
                        ]);
                    }
                }
            }


            ZCardWidget::end();
            ?>
        </div>
    </div>
</div>


<br><br><br>




    <? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>


    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
