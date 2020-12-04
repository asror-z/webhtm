<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\EyufNeedCompatriot;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\models\user\UserCompany;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Добавление потребностей к соотечественникам по запросу';
$action->icon = 'fa fa-dashboard';


$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');

if (empty($id))
    return $this->alertDanger( $id, Az::l('ID запроса отсутсвует'));



/*$request = \zetsoft\models\App\eyuf\EyufRequest::find()
    ->where([
        'id' => $id
    ])
    ->select(['name'])
    ->one();*/


/** @var EyufRequest $model */
$request = EyufRequest::findOne($id);


if ($request === null) {
    return $this->alertDanger( $id, Az::l('На эту страницу необходимо перейти с EyufRequest Page'));
}


$model = new EyufNeedCompatriot();

$model->configs->denyDB = $request->value;

$model->configs->nameOff = [
    'name',
    'user_company_id',
    'eyuf_request_id'
];

/*$company = new UserCompany();*/

$company_id = $this->userIdentity()->user_company_id;

//$company = UserCompany::findOne(['user_id' => $user_id]);

/*
$companyID = null;
if ($company !== null)
    $companyID = $company->id;*/


/*$model->configs->query = EyufNeedCompatriot::find()
    ->where([
        'user_company_id' => $company_id
    ]);*/


$model->user_company_id = $company_id;
$model->eyuf_request_id = $request->id;


$model->columns();

if ($this->modelSave($model)) {

    /**
     *
     * Post save Actions
     */

    $this->urlRedirect('/eyuf/logics/moderator/need-compatriot-index.aspx');
}
?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $active = new Active();
        $active->type = Active::type['horizontal'];
        $form = $this->activeBegin($active);


        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,
        ]);

        ZCardWidget::end();

        $this->activeEnd();

        ?>

    </div>
</div>
