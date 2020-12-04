<?php

/**
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\system\kernels\ZView;
use yii\web\View;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Просмотр  Запрос потребностей';
$action->icon = 'fa fa-dashboard';
$action->layout = true;
$action->debug = false;
$action->layoutFile = 'mainFrame';

$this->paramSet(paramAction, $action);

?>

<div id="page">

    <?
    echo ZSessionGrowlWidget::widget();
    ?>

    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <?

                $id = $this->httpGet('id');

                if (empty($id)) {
                    return null;
                }

                $model = EyufRequest::findOne($id);

                echo ZViewWidget::widget([
                    'model' => $model,
                ]);


                ?>
            </div>
        </div>
    </div>
</div>



