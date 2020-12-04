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


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\page\PageAction;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZVarDumper;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */
$action = new WebItem();
$action = new WebItem();
$action->type = WebItem::type['ajax'];
$action->debug = false;


$isAll = ZVarDumper::ajaxValue($this->httpGet('isAll'));
$path = str_replace('zetsoft/blocks/', '', $this->httpGet('param'));
$blockName = bname($path);
$id = \zetsoft\models\page\PageBlocks::findOne(['name' => $path])->id;

echo 'Вы выбрали блок ' . $blockName;

if (!$isAll)
    echo ZButtonWidget::widget([
        'config' => [
            'btnType' => ZButtonWidget::btnType['link'],
            'target' => ZButtonWidget::target['_blank'],
            'url' => "/core/blocks/grapes.aspx?block=" . $id,
            'text' => Az::l('Редактировать Блок')
        ]
    ]);
else
    echo "\n\nYou cannot edit this Block";



?>


