<?php

/**
 *
 *
 * Author:  Asror Zakirov
 *
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

namespace zetsoft\actions\crud;


use kartik\editable\Editable;
use yii\helpers\VarDumper;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZAction;

class ZIndexAjaxAction extends ZAction
{

    public function run()
    {

        $this->bread('Список');

        /** @var ZActiveRecord $model */
        $model = new $this->model;
        $model->search = true;

        $params = Az::$app->request->queryParams;
        $provider = $model->search($params);
        
        return $this->requireAjax('index', [
            'model' => $model,
        ]);
    }

}
