<?php


use zetsoft\models\menu\Menu;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZStatusWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\iconers\ZLangPickerWidgetDropdown;
use zetsoft\widgets\menus\ZMmenuWidget;

if (!$this->userIsGuest()) ZStatusWidget::widget([]);
/** @var ZView $this */
$baseUrl = $this->urlGetBase();


echo ZNProgressWidget::widget([]);

?>

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Баланс : 0 $</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Холд : 0 $</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <div class="d-flex">
                    <div>
                        <?
                        if (!$this->userIsGuest()){
                            ?>
                            <a class="nav-link" href="/cpas/client/profile-settings">
                                <i class="fal fa-user fa-2x"></i>
                                <span class="badge badge-dark navbar-badge"></span>

                                <?
                                $userName = $this->userIdentity()->title;
                                $userRole = $this->userRole();
                                ?>
                            </a>
                            <?
                        }
                        ?>
                    </div>
                    <div class="ml-2 mr-2">
                        <?
                        if (!empty($userName) && !empty($userRole)){
                            ?>
                            <span><?= $userName?></span>
                            <br>
                            <span><?= $userRole?></span>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <div class="">
                    <?
                    if($this->userIsGuest()){
                        ?>
                        <a href="/cpas/user/login-register.aspx">
                            <i class="far fa-sign-in ml-1 mr-2 mt-2" style="font-size: 30px; color: darkgrey"></i>
                        </a>

                        <?

                    }else{
                        ?>

                        <a href="/cpas/user/user-auth/logout.aspx">
                            <i class="far fa-sign-out ml-1 mt-2" style="font-size: 30px; color: darkgrey"></i>
                        </a>

                        <?
                    }
                    ?>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->
            <!--<li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                </div>
            </li>-->

        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="#" class="brand-link">
            <span class="brand-text font-weight-light">Arbit</span>
        </a>

        <?

        $menus = Menu::find()
            ->where([
                'id' => 23
            ])
            ->asArray()
            ->all();

        $parent = '';
        $json = null;

        foreach ($menus as $item) {
            $parent .= $item['name'];
            $json .= $item['json'];
        }

        $json = ZJsonHelper::decode($json);

        ?>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"">
                <?
                foreach ($json as $i){
                    $children = ZArrayHelper::keyExists('children', $i);
                    ?>

                    <li class="nav-item">
                        <a href="<?= $i[paramAction]?>" class="nav-link">
                            <i class="<?= $i['icon']?> nav-icon"></i>
                            <p><?= $i['text']?></p>
                            <?
                            if ($children){
                                ?>
                                <i class="right fas fa-angle-left"></i>
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
                                        <a href="<?= $child[paramAction]?>" class="nav-link">
                                            <i class="<?= $child['icon']?> nav-icon"></i>
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

    </aside>

    <div class="content-wrapper" id="page">

        <?= $content?>

    </div>

    <footer class="main-footer">

    </footer>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>








