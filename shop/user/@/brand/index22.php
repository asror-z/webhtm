<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\CompanyCardItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\menus\ZMetisMenuWidget;

$this->title();
$this->toolbar();

/** @var ZView $this */
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
<body class="<?= ZWidget::skin['white-skin'] ?> borderzz">
<?php

$this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>

<div class="container-fluid bg-white">

    <div class="row py-3">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <?
            echo ZSelect2Widget::widget([



            ]);

            ?>
        </div>


        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <h3 class="text-center"><?= Az::l('Бренды') ?></h3>
                <div class="col-md-12 d-flex flex-wrap">

                    <?


                    foreach ($items as $item) {
                        ?>
                        <div class="col-md-4 d-flex justify-content-center">
                            <?
                            echo $this->require( '/render/cards/ZCompanyCardWidget/ready/companyCard.php', [
                                'company' => $item
                            ]);
                            ?>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>


</div>

<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>



