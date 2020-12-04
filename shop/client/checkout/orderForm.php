<?php

/**
 *
 *
 * Author:  Maxamadjonov Jaxongir
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\core\WebItem;
use zetsoft\former\shop\ShopOrderForm;
use zetsoft\models\place\PlaceAdress;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;

use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZCKEditorWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\system\actives\ZModel;
use zetsoft\widgets\themes\ZCardWidget;
$action = new WebItem();

$action->title = Azl . 'Тестовые компоненты';
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

  


    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?php

                $model = new ShopOrderForm();

                if ($this->modelForm($model) === true) {

                  //  $this->modelPost();
                    /*   $company = new UserCompany();
                       $company->name = $model->name;
                       $company->title = $model->password;
                       $company->save();*/
                }

             
                $form = $this->activeBegin();

                ZCardWidget::begin([
                    'config' => [
                        'title' => $this->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                echo ZFormWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ]

                ]);

                ZCardWidget::end();

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













