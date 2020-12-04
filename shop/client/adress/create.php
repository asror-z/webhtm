<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\user\User;use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;

use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Создание Нового адреса';
$action->icon = 'fa fa-cropLength';
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

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?


                $id = $this->userIdentity()->id;
                $model = new PlaceAdress();



                if ($this->httpPost('PlaceAdress'))
                {

                    $post = $this->httpPost('PlaceAdress');
                    $model->name = ZArrayHelper::getValue($post, 'name');
                    $model->save();
                    
                    $user = $this->userIdentity();
                    $places = $user->place_adress_ids;
                    //vdd($model);
                    $places[] = "$model->id";
                    $user->place_adress_ids = $places;
                    
                    $user->save();

                    $this->urlRedirect(['mainBosya', true]);
                    
                }


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->ajaxBegin();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                ]);

                $this->ajaxEnd();

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
