<?php


use kartik\widgets\Alert;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\notifier\ZKAlertWidget;







/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Scholar';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/** @var User $user */
$user = $this->userIdentity();

if ($user->verified_email)
    $this->urlRedirect(['/eyuf/logics/scholar/add-info']);

//vdd($user);
$mail = $user->email;
$message = Az::l('Ссылка отправлена ​​по электронной почте: ') . $mail . EOL . Az::l('Для добавление информации необходимо подтвердить верификацию по электронной почте. Пожалуйста проверьте свой e-mail который ввели при регистрации!');

echo ZKAlertWidget::widget([
    'config' => [
        'type' => Alert::TYPE_DANGER,
        'title' => '&nbsp' . '&nbsp' . Az::l('Предупреждение !'),
        'body' => Az::l($message),
        'icon' => 'fas fa-exclamation-circle',
        'delay' => 0,
        'isShowSeparator' => true,
    ]
]);



