<ul class="navbar-nav">
    <li class="nav-item d-flex fend">
        <?php
        $pjax = new ZPjax();
        $pjax->class = 'd-flex justify-content-center align-items-center pt-1 mr-2';

        $this->pjaxBegin($pjax); ?>
        <div class="dropdown">
            <?
            /** @var ZView $this */
            if (!$this->userIsGuest())
                echo ZMessageWidget::widget([
                    'config' => [
                        'icon' => 'fas fa-2x fa-' . FA::_ENVELOPE,
                        'viewButtonTitle' => 'view all',
                        'title' => Az::l('Сообщения'),
                        'hint' => Az::l('Сообщения'),
                        'class'=>''
                    ]
                ]);
            ?>
        </div>
        <div class="dropdown">
            <?
            if (!$this->userIsGuest())
                echo ZNotifyWidget::widget([
                    'config' => [
                        'type' => ZNotifyWidget::type['mdb'],
                        'icon' => 'fa fa-2x fa-bell',
                        'title' => Az::l('Уведомления'),
                        'hint' => Az::l('Уведомления')
                    ]
                ]);
            ?>
        </div>
        <div class="dropdown">
            <?
            if (!$this->userIsGuest())
                echo ZFriendRequestsWidget::widget([
                    'config' => [
                        'type' => ZFriendRequestsWidget::type['facebook'],
                        'icon' => 'fas fa-2x fa-' . FA::_USERS,
                        'title' => Az::l('Запрос в друзья'),
                        'hint' => Az::l('Запрос в друзья'),
                    ]
                ]);


            ?>

        </div>
        <?php $this->pjaxEnd(); ?>

        <div class="d-flex align-items-center mt-2 mr-2 viewWidgetClass">
            <div class="pr-3">
                <?php

                echo $this->require( '/render/cards/@Other/ZCartViewWidget/page/cart.php');
                ?>
            </div>
            <!-- wish list button -->
            <div class="pr-3">
                <?php

                echo $this->require( '/render/cards/@Other/ZCartViewWidget/page/wish.php');
                ?>
            </div>

            <div class="pr-3">
                <?php

                $compareList = Az::$app->cores->session->get('compare');
                $compareAmount = 0;

                if (is_array($compareList))
                    $compareAmount = count($compareList);

                echo ZCartViewWidget::widget([
                    'id' => 'compare_list',
                    'config' => [
                        'url' => '/shop/user/compare/index.aspx',
                        'icon' => 'fa fa-chart-bar fa-align-center grey-text',
                        'text' => '',
                        'hint' => 'Сравнить',
                        'class' => 'ZCompareIcon',
                        'amount' => $compareAmount
                    ]
                ]);
                ?>
            </div>

            <div class="pr-3">
                <?php

                $viewList = Az::$app->cores->session->get('viewed');
                $viewAmount = 0;

                if (is_array($viewList))
                    $viewAmount = count($viewList);

                echo ZCartViewWidget::widget([

                    'config' => [
                        'url' => '/customer/viewed/index.aspx',
                        'icon' => 'fas fa-history grey-text',
                        'text' => '',
                        'hint' => 'Просмотренные',
                        'class' => 'ZViewedIcon',
                        'amount' => $viewAmount
                    ]
                ]);
                ?>
            </div>

        </div>

        <div class="RegisterBlockCarolinaRegisterBtn pr-0 pr-sm-4">

            <?= $this->require( '/webhtm/block/register/register.php'); ?>

        </div>
    </li>
</ul>
