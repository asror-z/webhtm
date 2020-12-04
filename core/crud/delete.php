<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */


/**
 *
 * Action Params
 * @license Shahzod Gulomqodirov
 */
 
$action = new WebItem();

$action->title = Azl . 'Потребности';
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->layout = true;
$action->layoutFile = 'admin';
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$modelClassName = $this->bootFullUrl();

/**
 *
 * Start Page
 */

?>

<div id="page">


    <div id="content" class="content-footer p-3">


 

        <div class="row">
            <div class="col-md-12 col-12">

                <?
                /** @var ZActiveRecord $model */
                if (class_exists($modelClassName)) {
                    $model = new $modelClassName();
                }else{
                    throw new NotFoundHttpException();
                }
                $model->configs->showDeleted = true;
                $model->columns();

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'title' => 'Удаленные данные | {title}',
                        'updateUrl' => '{fullUrl}/update.aspx?id={id}&model={modelClassName}',
                    ]
                ]);

                ?>

            </div>
        </div>


    </div>
  
</div>


