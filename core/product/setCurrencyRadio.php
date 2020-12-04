<?php


use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageAction;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */

$action = new WebItem();
$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-bar-chart';
$action->debug = false;
$action->csrf = false;


$this->paramSet(paramAction, $action);

$action->type = WebItem::type['ajax'];

$currency = $this->httpGet('currency');

Az::$app->cores->session->set('currency', $currency);
//$this->urlRedirect($this->urlGetBack());
