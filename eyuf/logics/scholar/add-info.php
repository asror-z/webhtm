<?php

use kartik\widgets\Alert;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\EyufManual;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;


/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Информация';
$action->icon = 'fa fa-dashboard';
$action->layout = true; $action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$user = $this->userIdentity();
$id = $this->userIdentity()->id;

$scholar = EyufScholar::find()
    ->where([
        'user_id' => $id
    ])
    ->one();

if ($scholar === null) {
    $this->alertWarning(Az::l('Стипендиант не найден'), $this->userIdentity()->id);
    return null;
}

/** @var EyufScholar $scholar */
$scholar->configs->nameOff = [
    'user_id',
    'completed',
    'edu_start',
    'edu_end',
    'company_type',
    'edu_area',
    'edu_sector',
    'edu_type',
    'currency'
];

if ($this->modelSave($scholar)) {

    $scholar = EyufScholar::findOne($scholar->id);
    $scholar->age = Az::$app->App->eyuf->scholar->getAge($scholar->birthdate);
    $scholar->save();

    /** @var User $user */
    $url = $this->bootEnv('urlScholarIndex');
    $this->urlRedirect([$url]);
}


?>

<div class="row">
    <div class="col-md-12 col-12">
                        
        <?

            $active = new Active();
            $active->type = Active::type['horizontal'];
            $form = $this->activeBegin($active);

            echo ZFormWidget::widget([
                'model' => $scholar,
                'form' => $form,
            ]);
    
            $this->activeEnd();
    
        ?>

    </div>
</div>

