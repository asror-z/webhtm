<?php

use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\models\menu\Menu;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;

echo ZSessionGrowlWidget::widget();
echo ZNProgressWidget::widget([]);

?>



<ul id="metismenu">
    <li class="mm-active">
        <a href="#" aria-expanded="true">Menu 1</a>
        <ul>

        </ul>
    </li>
    <li>
        <a href="#" aria-expanded="false">Menu 2</a>
        <ul>
            
        </ul>
    </li>
</ul>


