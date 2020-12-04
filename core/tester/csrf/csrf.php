<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * Date:    9/14/2019
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreInput;
use zetsoft\models\user\User;
use zetsoft\models\test\TestSecond5;
use zetsoft\models\test\TestSecond6;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZFormWidgetTerrabayt;


/** @var ZView $this */

$laptop = new CoreInput();



$action = new WebItem();

$action->title = Azl . 'Детали Тип транспортного средства';
$action->icon = 'fa fa-graduation-cap';
$action->type = WebItem::type['ajax'];
$action->csrf = false;
$action->debug = true;



$this->paramSet(paramAction, $action);

$this->title = 'Вход в систему ZAllApps';

// echo <<<HTML
//<form class="form-horizontal kv-form-horizontal kv-form-bs4" action="#" method="post" enctype="multipart/form-data" data-pjax="0">
//
//HTML;
//
//
//$five = $this->modelGet(TestSecond5::class);
//
//$this->modelSave($five);
//
//echo ZFormWidgetTerrabayt::widget([
//    'model' => $five,
//    'formName' => 'asfasfas',
//    'config' => [
//        'topBtn' => false,
//        'botBtn' => false,
//    ]
//]);
//
// echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
//echo "</form>";
//                 ?>
                 
<form action="#" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
