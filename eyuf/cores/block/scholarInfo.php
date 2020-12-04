<!-- start|AzimjonToirov|2020:10:26 -->
<?php

/** @var ZView $this */

use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\assets\ZColor;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\user\User;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\former\ZViewWidget;

$userImages = $this->userIdentity()->photo;
$userId = $this->userIdentity()->id;
$userTitle = $this->userIdentity()->title;
$isScholar = $this->userRole() === 'scholar';

if ($isScholar)
    $scholarAge = Az::$app->App->eyuf->user->getAge($scholar->birthdate);


ZCardProfileWidget::begin([
    'config' => [
        'url' => $this->userPhoto(),
        'color' => ZColor::color['primary-color'],
        'title' => $isScholar ? $scholar->title : $userTitle,
    ]
]);

$statuses = (new EyufScholar())->_status;

if ($isScholar) {
    echo 'Статус: ' . $statuses[$scholar->status];
    echo '<br>';
    echo 'Возраст: ' . $scholarAge . EOL;
}

ZCardProfileWidget::end();

if ($isScholar) {
    $scholar->configs->nameOn = [
        'id',
        'name',
        'program',
        'passport',
        'passport_give',
        'birthdate',
        'user_id',
        'place_country_id',
        'status',
        'edu_start',
        'age',
        'edu_end',
        'currency',
        'user_company_id',
        'company_type',
        'edu_area',
        'edu_sector',
        'edu_type',
        'speciality',
        'edu_place',
        'finance',
        'address',
        'phone',
        'home_phone',
        'email',
        'position',
        'experience',
        'completed',
    ];
    $scholar->columns();
}

$user = User::findOne($userId);
$user->configs->nameOn = [
    'id',
    'name',
    'title',
    'role',
    'gender',
    'lang',
    'phone',
    'number'
];
$user->columns();

echo ZViewWidget::widget([
    'model' => $isScholar ? $scholar : $user,
]);
?>
<!-- end|AzimjonToirov|2020:10:26 -->
