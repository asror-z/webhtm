<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Пользователи';
$action->icon = 'fal fa-barcode-alt';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;



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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">

                <?


                $id = $this->httpGet('id');
                $model = new User();

                if ($this->modelSave($model)) {

                    /**
                     *
                     * Post save Actions
                     */
                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'index',
                        'sort' => '-id'
                    ]);
                }


                $active = new Active();
                $active->type = Active::type['vertical'];
                $form = $this->activeBegin($active);

                $isCard = true;
                if ($this->httpGet('spa'))
                    $isCard = false;

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'isCard' => $isCard,
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked'],
                    ]
                ]);

                $this->activeEnd();



                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
