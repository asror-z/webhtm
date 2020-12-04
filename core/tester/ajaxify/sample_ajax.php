<?php

use yii\debug\Module;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\UserCompany;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZInfinityScrollAjaxWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$this->paramSet('widget', true);

$action = new WebItem();
$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);


?>

<?php
$model = new UserCompany();
$attribute = 'attribute';

echo ZKSelect2Widget::widget([
    'model' => $model,
    'attribute' => $attribute
]);
echo ZFileInputWidget::widget([
    'model' => $model,
    'attribute' => $attribute
])

?>
