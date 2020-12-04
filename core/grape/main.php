<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageThemeType;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetMaladoy;
use zetsoft\widgets\iconers\ZLangPickerWidget;


/** @var ZView $this */

/**
 *
 * Action Params
 *  @author : MurodovMirbosit AbdulllohTursunaliyev
 */

$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->paramSet('widget', true);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMain.css');
    ?>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<!--card section start -->

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 p-5">

            <div class="d-flex">
                <?php

                /** @var PageThemeType $model */

                $models = PageThemeType::find()
                    ->orderBy([
                        'id' => SORT_DESC,
                    ])
                    ->all();

                foreach ($models as $model)
                {
                ?>
                <div class="col-md-4 border grapesCard"
                     style="background: url('<?php $model->image ?>'); background-size: 100%;">
                    <div class="eventBtns d-none">
                        <a class="btn eventBtn select-btn text-dark d-felx"><?php $model->title ?></a>
                        <a class="btn eventBtn text-dark d-felx"><?php $model->title ?></a>
                    </div>
                </div>

                   <?php

                    }
                ?>
            </div>

        </div>
    </div>
</div>

<!-- card section end -->


<script>
    $('.grapesCard').on('mouseenter', function () {
        $('.eventBtns').removeClass('d-none');
    });
    $('.grapesCard').on('mouseleave', function () {
        $('.eventBtns').addClass('d-none');
    });

    $('.select-btn').on('click', function () {
        alert(1);
    })
</script>


<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
