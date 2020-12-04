<?

use kartik\widgets\Alert;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;

/** @var User $user */
$user = $this->userIdentity();

$mail = $user->email;
$message = Az::l('Ссылка отправлена ​​по электронной почте: ' ). $mail . EOL . Az::l('Для добавление информации необходимо подтвердить верификацию по электронной почте. Пожалуйста проверьте свой e-mail который ввели при регистрации!');

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



