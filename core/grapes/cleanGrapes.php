<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\menus\ZMmenuWidgetSh;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\WareReturn;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'ZetGrapes';
$action->icon = 'fal fa-balance-scale';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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

    $this->fileCss('https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.12.17/css/grapes.min.css');
    $this->fileJs('https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.12.17/grapes.min.js');
    $this->fileJs('https://cdn.jsdelivr.net/npm/grapesjs-preset-webpage@0.1.11/dist/grapesjs-preset-webpage.min.js');

    $this->head();

    ?>


    <style>

        .gjs-block {
            width: auto;
            height: auto;
            min-height: auto;
        }
        .editor-row {
            display: flex;
            justify-content: flex-start;
            align-items: stretch;
            flex-wrap: nowrap;
            height: 300px;
        }

        .editor-canvas {
            flex-grow: 1;
        }

        .panel__right {
            flex-basis: 230px;
            position: relative;
            overflow-y: auto;
        }

        .panel__top {
            padding: 0;
            width: 100%;
            display: flex;
            position: initial;
            justify-content: center;
            justify-content: space-between;
        }
        .panel__basic-actions {
            position: initial;
        }
    </style>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>




<div id="page">


    <div id="gjs">
        
    </div>

    <div id="blocks"></div>
    



</div>


<script>
    const editor = grapesjs.init({
        // Indicate where to init the editor. You can also pass an HTMLElement
        container: '#gjs',
        // Get the content for the canvas directly from the element
        // As an alternative we could use: `components: '<h1>Hello World Component!</h1>'`,
        fromElement: true,
        // Size of the editor
        height: '300px',
        width: 'auto',
        // Disable the storage manager for the moment
        storageManager: false,
        // Avoid any default panel
        panels: { defaults: [] },
        plugins: [['gjs-preset-webpage'],
        pluginsOpts: {
            'gjs-preset-webpage': {
                ['link-block', 'quote', 'text-basic']
            }
        }


        blockManager: {
            appendTo: '#blocks',
            blocks: [
                {
                    id: 'section', // id is mandatory
                    label: '<b>Section</b>', // You can use HTML/SVG inside labels
                    attributes: { class:'gjs-block-section' },
                    content: `<section>
          <h1>This is a simple title</h1>
          <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
        </section>`,
                }, {
                    id: 'text',
                    label: 'Text',
                    content: '<div data-gjs-type="text">Insert your text here</div>',
                }, {
                    id: 'image',
                    label: 'Image',
                    // Select the component once it's dropped
                    select: true,
                    // You can pass components as a JSON instead of a simple HTML string,
                    // in this case we also use a defined component type `image`
                    content: { type: 'image' },
                    // This triggers `active` event on dropped components and the `image`
                    // reacts by opening the AssetManager
                    activate: true,
                }
            ]
        },
    });

</script>




<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
