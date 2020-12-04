<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\service\forms\ZPjax;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
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
$pjax->class = 'd-flex flex-column';

$this->pjaxBegin($pjax); ?>
    <div class="btn-group dropleft pb-3">
        <?
        /** @var ZView $this */
        #if (!$this->userIsGuest())
            echo ZMessageWidget::widget([
                'config' => [
                    'icon' => 'fa-2x far fa-' . FA::_ENVELOPE,
                    'viewButtonTitle' => 'view all',
                    'title' => Az::l('Сообщения'),
                    'hint' => Az::l('Сообщения'),
                    'iconSize' => '25px;'
                ]
            ]);
        ?>
    </div>
    <div class="btn-group dropleft pb-3">
        <?
        #if (!$this->userIsGuest())
            echo ZFriendRequestsWidget::widget([
                'config' => [
                    'type' => ZFriendRequestsWidget::type['facebook'],
                    'icon' => 'fas fa-' . FA::_USERS,
                    'title' => Az::l('Запросы в друзья'),
                    'hint' => Az::l('Запросы в друзья'),
                ]
            ]);

        ?>

    </div>
    <div class="btn-group dropleft pb-3">
        <?
        #if (!$this->userIsGuest())
            echo ZNotifyWidget::widget(['config' => ['type' => ZNotifyWidget::type['mdb'],
                'icon' => 'far fa-bell',
                'title' => Az::l('Уведомления'),
                'hint' => Az::l('Уведомления')]]);
        ?>
    </div>

<?php $this->pjaxEnd(); ?>

