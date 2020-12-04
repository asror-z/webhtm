<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\widgets\themes\ZMessageWidget;
use zetsoft\widgets\themes\ZNotifyWidget;

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

$pjax = new ZPjax();
$pjax->class = 'd-flex msg align-items-center';

$this->pjaxBegin($pjax); ?>


<div class="dropdown pr-3">
    <?
    /** @var ZView $this */
    if (!$this->userIsGuest())
        echo ZMessageWidget::widget([
            'config' => [
                'icon' => 'fp-27 mt-1 fal fa-' . FA::_ENVELOPE,
                'viewButtonTitle' => 'view all',
                'title' => Az::l('Сообщения'),
                'hint' => Az::l('Сообщения'),
                'iconSize' => '25px;'
            ]
        ]);
    ?>
</div>
<div class="dropdown pr-3">
    <? if (!$this->userIsGuest())
        echo ZNotifyWidget::widget([
        'config' => [
            'type' => ZNotifyWidget::type['mdb'],
            'icon' => 'fal fa-bells fp-27 mt-1',
            'title' => Az::l('Уведомления'),
            'hint' => Az::l('Уведомления')]]);
    ?>
</div>

<?php $this->pjaxEnd(); ?>
