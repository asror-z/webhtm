<?php
/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageBlocks;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$isAll = ZVarDumper::ajaxValue($this->httpGet('isAll'));
$path = str_replace('zetsoft/blocks/', '', $this->httpGet('param'));

$pageBlock = PageBlocks::findOne([
    'name' => $path
]);

if (!$pageBlock)
    return null;

?>
<div class="text-center">

    <h6 class="title-option">Вы выбрали блок <?= $pageBlock->title ?></h6>
    <?

    /*if (!$isAll)
        echo ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'target' => ZButtonWidget::target['_blank'],
                'url' => "/core/blocks/grapes.aspx?block=$pageBlock->id,",
                'text' => Az::l('Редактировать Блок')
            ]
        ]);
    else
        echo "\n\nYou cannot edit this Block";*/

    echo ZButtonWidget::widget([
        'config' => [
            'btnType' => ZButtonWidget::btnType['link'],
            'target' => ZButtonWidget::target['_blank'],
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-info'],
            'url' => "/core/grape/edit.aspx?blockId=$pageBlock->id",
            'text' => Az::l('Редактировать Блок')
        ]
    ]);


    ?>
</div>


