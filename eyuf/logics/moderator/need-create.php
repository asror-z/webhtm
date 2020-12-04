
?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufNeed;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\models\user\UserCompany;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;

/** @var ZView $this */

$action = new WebItem();
$action->layout = true;

$action->title = Azl . 'Добавление потребностей к стипендиантам по запросу';
$action->icon = 'fa fa-dashboard';


$action->layout = true;
$action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');
/*$request = \zetsoft\models\App\eyuf\EyufRequest::find()
    ->where([
        'id' => $id
    ])->select(['name'])->one();*/


/** @var EyufRequest $model */

$request = EyufRequest::findOne(['id' => $id]);

if ($request === null) {
    return $this->alertDanger( $id, Az::l('На эту страницу необходимо перейти с EyufRequest Page'));
}


//vdd($id);
/*vdd($request->value);
if (empty($request->attributes)){
    return $this->alertDanger( 'Ввод данных ограничен.', 'Ошибка');
}*/

//vdd($id);

$company_id = $this->userIdentity()->user_company_id;

$model = new EyufNeed();

$company = UserCompany::findOne([
    'id' => $company_id
]);

/*
$companyID = null;
if ($company !== null)
    $companyID = $company->id;*/


$model->configs->query = EyufNeed::find()
    ->where([
        'user_company_id' => $company_id
    ]);

$model->configs->denyDB = $request->value;

$model->configs->nameOff = [
    'user_company_id',
    'name',
    'eyuf_request_id'
];


$model->user_company_id = $company_id;
$model->eyuf_request_id = $request->id;

$model->columns();

if ($this->modelSave($model)) {

    /**
     *
     * Post save Actions
     */
    $url = ZUrl::to([
        '/eyuf/logics/moderator/need-request'
    ]);
    $this->urlRedirect($url);
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
