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


use zetsoft\system\Az;
use zetsoft\system\kernels\ZAction;

class test extends ZAction
{

    public function run()
    {


        $modelClassName = $this->httpGet('modelClassName');
        $modelClass = $this->bootFull($modelClassName);

        $keys = $this->httpPost('keys');
        //vdd($keys);

        $keysExp = explode('|', $keys);

        if ($keysExp)
            foreach ($keysExp as $id) {
                if ($id) {
                    $model = $this->modelClone($modelClass, $id);
                    $this->modelSave($model);
                }
            }

        $this->notifySuccess('Данные успешно клонированы!', $keys);

        return $this->urlRedirect(['test2', true]);
    }


}
