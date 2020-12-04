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


$get = $this->httpGet('param');
$param = str_replace('/', '\\', $get);
$param = str_replace('zetsoft', '', $param) . '.php';

echo "<!--TEMPLATEBEGIN-->
<div class='widgetsWrap' widget='$get'>
";

echo $this->requireAjaxFilePreg(Root . $param);

echo "
      </div>
      <!--TEMPLATEEND-->
      <!--\$this->require_block(Root . '$param');-->
";
