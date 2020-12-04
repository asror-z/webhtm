<?php
/**
 * @author: AzimjonToirov
 *
 */

use rmrevin\yii\fontawesome\FA;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\widgets\themes\ZMessageWidget;
use zetsoft\widgets\themes\ZNotifyWidget;

$pjax = new ZPjax();
$pjax->class = 'd-flex msg align-items-center';

$this->pjaxBegin($pjax); ?>
<div class="dropdown pr-3 text-light/shop/client/checkout/maining">
    <?
    /** @var ZView $this */
   
        echo ZMessageWidget::widget([
            'config' => [
                'icon' => 'fp-25 mt-1 fal fa-comment-alt ',
                'viewButtonTitle' => 'view all',
                'title' => Az::l('Сообщения'),
                'hint' => Az::l('Сообщения'),
                'iconSize' => '25px;'
            ]
        ]);
    ?>
</div>

<div class="dropdown pr-3 text-lighting">
    <? 
        echo ZNotifyWidget::widget([
            'config' => [
                'type' => ZNotifyWidget::type['mdb'],
                'icon' => 'fal fa-bell fp-25 mt-1 text-lighting',
                'title' => Az::l('Уведомления'),
                'hint' => Az::l('Уведомления')]]);
    ?>
</div>

<?php $this->pjaxEnd(); ?>
