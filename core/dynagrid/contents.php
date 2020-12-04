<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\dbitem\data\TabItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


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


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">
        <?php

        /* @var ZActiveRecord $model */
        $modelName = $this->bootFull($this->httpGet('model'));

        $id = ZArrayHelper::getValue($this->httpGet(), 'id');
        $url = ZArrayHelper::getValue($this->httpGet(), 'url');

        $theme = str_replace('panel-', '', $this->httpGet('theme'));

        $service = Az::$app->smart->dyna;
        $model = new $modelName();

        $coreDyna = DynaConfig::findOne([
            'dynaId' => $id
        ]);

        if ($this->httpPost('DynaSorting')) {

            if (!$coreDyna)
                $coreDyna = new DynaConfig();

            $string = ZArrayHelper::getValue($this->httpPost('DynaSorting'), 'visible');
            $array = explode(',', $string);

            $coreDyna->sort = $array;
            $coreDyna->dynaId = $id;
            $coreDyna->save();

        }

        echo $this->require( '/webhtm/core/dynagrid/filter.php', [
            'modelClass' => $this->httpGet('model'),
            'theme' => $theme,
            'id' => $id,
            'url' => $url,
        ]);

        ?>

        <script>
              $(document).on('click', '.get-columns', function (e) {
                  let attribute = $(e.target).data('item');

                  $('#page').loader('show')

                  $.ajax({
                      type: 'GET',
                      url: '/core/dynagrid/dynaform.aspx?id=<?=$this->httpGet('id')?>&attribute=' + attribute + "&model=<?=$this->httpGet('model')?>",
                    success: function (response) {
                        let icon = $(e.target).find('i').attr('class');
                        let text = $(e.target).text().trim();

                        $('#page').loader('hide');

                        $('.optionsCard-title').text(text);
                        $('.optionsCard-icon').attr('class', 'optionsCard-icon ' + icon);
                        $('#optionsDyna').html(response);
                    }
                });
            });

            /* $(document).on('complete.ic', function (evt, elt, data, settings, xhr, requestId) {
                 setTimeout(function () {
                     $('#content-options').loader('hide');
                 }, 500);
             });
 */
            /* $('.nav-link').on('click', function (event) {
                 let parent = $('.nav-item');
                 $('#content-options').loader('show');

                 parent.find('.active').removeClass('active');
                 parent.find('.disabled-tab').removeClass('disabled-tab');

                 if (!$(event.target).hasClass('active')) {

                     $(event.target).addClass('active');
                     $(event.target).addClass('disabled-tab');
                 }
             });*/
        </script>

    </div>

</div>
<style>
    #content-panel-id {
        padding: 0;
    }

    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label {
        padding: 0 !important;
        width: 50%;
    }
    .nav-item {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 20% !important;
    }
</style>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



