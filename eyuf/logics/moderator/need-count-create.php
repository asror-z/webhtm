<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufNeedCount;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Новый потребност по количеству на запрос';
$action->icon = 'fa fa-dashboard';

$action->layout = true;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');

/** @var EyufRequest $request */

$request = EyufRequest::findOne($id);

if ($request === null) {
    return $this->alertDanger( $id, Az::l('На эту страницу необходимо перейти с EyufRequest Page'));
}

$needCount = new EyufNeedCount();

$needCount->configs->denyDB = $request->value;

$company_id =$this->userIdentity()->user_company_id;


/*$company = UserCompany::find()->where([
    'id' =>
])->one();*/

/*$companyID = null;
if ($company !== null)
    $companyID = $company->id;*/


$needCount->query = EyufNeedCount::find()
    ->where([
        'user_company_id' => $company_id,
    ]);

$needCount->configs->nameOff = [
    'name',
    'user_company_id',
    'eyuf_request_id'
];

$needCount->user_company_id = $company_id;
$needCount->eyuf_request_id = $request->id;

$needCount->columns();

?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);

        echo ZFormWidget::widget([
            'model' => $needCount,
            'form' => $form,
            'config' => [
                'stepType' => ZFormBuildWidget::stepType['none'],
                'blockType' => ZFormBuildWidget::blockType['naked'],
            ],
        ]);


        if ($this->modelSave($needCount)) {

            $this->urlRedirect('/eyuf/logics/moderator/need-count-request.aspx');
        }

/*        if ($this->modelSave($needCount)) {



            $url = ZUrl::to([
                '/eyuf/logics/moderator/need-count-request'
            ]);
            return $this->urlRedirect($url);
        }*/

        $this->activeEnd();


        ?>

    </div>
</div>
