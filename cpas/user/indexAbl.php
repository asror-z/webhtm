<?php

use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\menu\Menu;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZAdminCardWidgetNew;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'ArbitPro';
$action->icon = 'fa fa-pie-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;


$action->loader = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$content = '';


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    

    $this->head();

    ?>
    <link rel="stylesheet" href="/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/render/asrorz/css-app/arbitTemplate/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<style>
    body {
        overflow-x: hidden;
        width: 100%;
    }
</style>

<body class="hold-transition sidebar-mini">
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

    <div class="content-wrapper">
          <?
            $content
          ?>
    </div>

    <footer class="main-footer">
       
    </footer>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>

</div>


<script src="/render/asrorz/fontawesome-pro-5.12.0-web/js/ALL.js"></script>
<script src="/render/asrorz/css-app/arbitTemplate/dashboard.js"></script>
<script src="/render/asrorz/css-app/arbitTemplate/adminlte.min.js"></script>
        
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
