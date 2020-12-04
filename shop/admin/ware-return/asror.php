<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZPdfSimpleWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZDropDownWidget;
use zetsoft\models\place\PlaceCountry;
use function Clue\StreamFilter\fun;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Возврат товаров от клиентов';
$action->icon = 'fal fa-balance-scale';
$action->type = WebItem::type['html'];
$action->csrf = true;




$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/*vd($this->urlMain);
vd($this->urlParam);
vd($this->urlArray);
vd($this->urlModule);
vd($this->urlModuleStr);
vd($this->urlParamStr);*/
vd($this->urlScript);
vd($this->urlPath);
vd($this->urlArrayStr);


vdd();

$this->urlRedirect([
    'index',
    'sort' => '-id'
]);


$this->urlRedirect('/shop/admin/ware-return/index.aspx?sort=-id');

