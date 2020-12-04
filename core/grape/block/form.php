<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\grape\GrapeForm;
use zetsoft\service\forms\Active;
use zetsoft\service\forms\Ajaxer;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->loader = false;
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

?>


<div class="content p-3">

    <?php

    $active = new Ajaxer();
    $active->id = 'grapesBlockForm';

    $form = $this->ajaxBegin($active);

    $model = new GrapeForm();

    echo ZFormWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
        ],
    ]);

    $this->ajaxEnd();
    
    ?>

</div>

<?$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
