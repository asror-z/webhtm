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
use zetsoft\system\kernels\ZView;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



$this->paramSet(paramAction, $action);

/*
$get = $this->httpGet('param');
$param = str_replace('/', '\\', $get);
$param = str_replace('zetsoft', '', $param) . '.php';*/

$param = $this->httpGet('param');
//$param = str_replace('/', '\\', $get);

$param = '/webhtm/block' . $param . '.php';

$basename = bname($param);

echo "<!--TEMPLATEBEGIN-->
<div class='widgetsWrap' widget='$param' basename='$basename'>
";

echo $this->requireAjax($param);

echo "
      </div>
      <!--TEMPLATEEND-->
      <!--\$this->require_block(Root . '$param');-->
";
