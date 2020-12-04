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

namespace zetsoft\actions\files;


use zetsoft\system\Az;
use zetsoft\system\kernels\ZAction;
use zetsoft\system\module\Models;

class ZExportActionOld extends ZAction
{


    /**
     *
     * Function  run
     * @param Models $model
     * @param $attribute
     * @return  bool
     * @throws \yii\base\Exception
     */
    public function run()
    {

        Az::$app->controller->enableCsrfValidation = false;

        /*
         *
         *
         * export_type: Pdf
modelClassName: EyufScholar
export_columns: []
column_selector_enabled: 1

        */

        $modelClassName = $this->httpGet('modelClassName');
        $column_selector_enabled = $this->httpPost('column_selector_enabled');
        $modelClass = $this->bootFull($modelClassName);

        /** @var Models $model */
        $model = new $modelClass();


        Az::$app->forms->export->columnSelector = $column_selector_enabled;
        Az::$app->forms->export->selectedColumns = $column_selector_enabled;
        Az::$app->forms->export->run($model);

        return true;
    }

}
