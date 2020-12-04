<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\core\CoreInput;


/** @var ZView $this */

                           
/**
 *
 * Action Params
 */
 
$action = new WebItem();

$action->title = Azl . 'Тестовые компоненты';
$action->icon = 'fa fa-cropLength';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->layoutFile = 'admin';



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>
    <div id="content" class="content-footer p-3">


 

        <div class="row">
            <div class="col-md-12">

            <?
            $this->urlRedirect(['main'])
            ?>


            </div>
        </div>


    </div>

</div>
