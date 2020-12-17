<?php

use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\models\menu\Menu;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;

echo ZSessionGrowlWidget::widget();
echo ZNProgressWidget::widget([]);
/** @var \zetsoft\system\kernels\ZView $this */

?>

<div class="wrapper">
    <nav class="main-header navbar arbit-navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link menupush" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          <?php  if(!$this->userIsGuest() && !($this->userIdentity()->role === 'admin')){?>
            <li class="nav-item">
                <a href="#" class="nav-link cash-link">
                    <i class="fal fa-wallet cash-icon"></i>
                </a>
            </li>
            <?php
                require Root . '/webhtm/cpas/client/balance.php';
            }
            ?>
        </ul>
      <ul class="navbar-nav text-center">
        <li class="nav-item nav-link">Менеджер: Шохрух <a href="https://t.me/shox1810" target="_blank" class="text-blue">телеграм</a></li>
      </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="d-flex align-items-center">
                    <div>
                        <?
                        if (!$this->userIsGuest()){
                            $userName = $this->userIdentity()->email;
                            $userRole = $this->userRole();
                            ?>
                            <a class="nav-link" href="/cpas/<?= $userRole?>/profile-settings.aspx">
                                <i class="fal fa-user user-icon--navbar"></i>
                                <span class="badge badge-dark navbar-badge"></span>

                            </a>
                            <?
                        }
                        ?>
                    </div>
                    <div class="mr-2 p-1">
                        <?
                        if (!empty($userName) && !empty($userRole)){
                            ?>
                            <span class="navbar-name"><?= $userName?></span>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </li>

            <li class="nav-item d-flex align-items-center justify-content-center border-left pl-3">
                <div class="">
                    <?
                    if($this->userIsGuest()){
                        ?>
                        <a href="/cpas/user/login-register.aspx">
                            <i class="far fa-sign-in ml-1 mr-2 mt-2" style="font-size: 20px; color: darkgrey"></i>
                        </a>

                        <?

                    }else{
                        ?>

                        <a href="/cpas/user/user-auth/logout.aspx">
                            <i class="fal fa-sign-out grey-text" style="font-size: 20px; color: darkgrey"></i>
                        </a>

                        <?
                    }
                    ?>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link w-100 text-center">
            <span class="brand-text menu-text font-weight-light">Arbit <span class="menu-text--pro">Pro</span></span>
        </a>

        <?
        if(!$this->userIsGuest()){
        $menus = Menu::find()
            ->where([
                'title' => $userRole
            ])
            ->asArray()
            ->all();

        $parent = '';
        $json = [];

            //vdd($menus);
        foreach ($menus as $item) {
            //vdd($item);
            $parent .= $item['name'];
            $json[] = ZArrayHelper::merge($json, $item['json']);
        }
          //vdd($json);
          $newJson = [];
          foreach ($json as $key => $value)
          {
            foreach ($value as $val)
                $newJson[] = $val;
          }
           //vdd($newJson);
        //$json = ZJsonHelper::decode($json);

        ?>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"">
                <?
                //vdd($json);
                foreach ($newJson as $i){
                    //vdd($i);
                    if (empty($i['icon'])) {
                        $i['icon'] = 'fa-chart-bar';
                    }
                    
                    $children = ZArrayHelper::keyExists('children', $i);
                    ?>
 
                    <li class="nav-item">
                        <a href="<?= $i['action'].'.aspx'?>" class="nav-link  d-flex">
                            <i class="fal <?= $i['icon']?> nav-icon mt-1"></i>
                            <p class="menu-links"><?= $i['text']?></p>
                            <?
                            if ($children){
                                ?>
                                <i class="right fal fa-angle-left"></i>
                                <?
                            }
                            ?>
                        </a>
                        <?

                        if ($children){
                            foreach ($i['children'] as $child){
                                ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= $child['action'].'.aspx'?>" class="nav-link">
                                            <i class="fal <?= $child['icon']?> nav-icon"></i>
                                            <p><?= $child['text']?></p>
                                        </a>
                                    </li>
                                </ul>
                                <?
                            }
                        }
                        ?>
                    </li>
                    <?
                }
                ?>
                </ul>
            </nav>

        </div>

        <?
        }
        ?>

    </aside>
    <div class="content-wrapper">

