<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbdata\App\eyuf\RoleData;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\models\menu\Menu;
use zetsoft\models\page\PageView;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZJsonHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
use zetsoft\widgets\incores\ZMCheckboxWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;

//assets CSS


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Главная страница';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->fileJs('https://cdn.jsdelivr.net/npm/jquery-sortable-lists@1.4.0/jquery-sortable-lists.js');
    $this->fileCss('/render/menus/assets/css/editor.css');
    $this->fileJs('https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js');
    $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.min.js');
    $this->head();
    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php

$this->beginBody();


/** @var ZView $this */
$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( $this->httpGet(), 'Please put an ID');

$model = Menu::findOne($id);

if ($model === null) {
    return $this->alertDanger( 'Model not found', 'Error');
}


$json = Az::$app->menu->json->run($model);

if (Az::$app->request->isPost && $model->load(Az::$app->request->post())) {
    $model->json = json_decode((string)$model->json, true, 512);

    if ($model->save())
        Az::$app->controller->refresh();
}

$titles = ZArrayHelper::map($actions, 'name', 'title');
$action = ZArrayHelper::map($actions, 'name', 'data');
$icons = ZArrayHelper::map($actions, 'name', 'icon');

$roles = (new RoleData)->name();

$titleJS = ZJsonHelper::encode($titles);
$iconJS = ZJsonHelper::encode($icons);
$actionJS = ZJsonHelper::encode($action);

$menutable = 'menu';


echo $this->require( '/webhtm/core/menu/blocks/center.php', [
    'model' => $model,
    'action' => $action,
    'titles' => $titles,
    'roles' => $roles,
    'json' => $json,
]);

?>

<?php

$createMenuJS = file_get_contents(Root . '/render/menus/assets/js/editor_library.js');

$editor_js = file_get_contents(Root . '/render/menus/assets/js/editor_js.js');

$editor_js = strtr($editor_js, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
    '{menutable}' => $menutable,
]);

$createMenuJS = strtr($createMenuJS, [
    '{titles}' => $titleJS,
    '{action}' => $actionJS,
    '{icons}' => $iconJS,
    '{json}' => $json,
]);

$this->registerJs($createMenuJS);
$this->registerJs($editor_js);
?>

<style>
    #setDat {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    #delMen {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    #btnAdd {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        height: 41px;
    }

    #btnUpdate {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        height: 41px;
    }

    .card-header i {
        font-size: 30px;
        margin-right: 10px;
    }

    #ac_btn {
        width: 10px;
        height: 40px;
        margin-right: 10px;
        padding: 22px;
        text-align: center;
        position: relative;
    }

    #bta {
        width: 10px;
        height: 40px;
        margin-right: 10px;
        padding: 22px;
        position: relative;
    }

    .iconColor-bta {
        font-size: 13px !important;
        margin-bottom: 10px !important;
        position: absolute;
        top: -5px;
        left: -4px;
    }

    .iconColor-ac_btn {
        font-size: 13px !important;
        margin-bottom: 10px !important;
        position: absolute;
        top: -5px;
        left: -4px;
    }

    #param-app {
        margin-left: 10px;
    }

    #icon_value-app {
        margin-left: 10px;
    }

    #targetValue {
        margin-left: 20px;
    }

    .section-1 {
        padding: 5px;
    }

    .section-2 {
        padding: 5px;
    }

    .card-header {
        height: 50px;
        text-align: center;
    }

    .card-header i {
        font-size: 25px;
    }

    .card-header h5 {
        text-align: center;
        font-size: 20px;
    }
</style>
<script>
    $(function () {
        let forms = $('.highlight-addon');
        forms.removeClass('form-group');
    });
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>









