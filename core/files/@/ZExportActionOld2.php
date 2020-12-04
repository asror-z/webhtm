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


use yii\web\HttpException;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZAction;
use zetsoft\system\module\Models;
use zetsoft\widgets\former\ZExportMenu;


class ZExportAction extends ZAction
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

        /** @var Models $model */
        /*
         *
         *
         * export_type: Pdf
            modelClassName: EyufScholar
            export_columns: []
            column_selector_enabled: 1

        */

        /*
         * /admin/core-blocked/export.aspx?modelClassName=Document&type=xlsx&ids=2|3|5
         * */



        $modelClassName = $this->httpGet('modelClassName');
        if (empty($modelClassName))
            throw new \InvalidArgumentException('modelClassName required', 403);

        $type = $this->httpGet('type');
        if (empty($type))
            throw new \InvalidArgumentException('type required', 403);

        $ids = $this->httpGet('ids');
        if (empty($ids))
            throw new \InvalidArgumentException('ids required', 403);

        $modelClass = $this->bootFull($modelClassName);

        $model = new $modelClass();

        if ($model === null)
            return null;

        $provider = $model->search();
        $provider->pagination = false;

        $columns = $model->columnsList([dbTypeJsonb]);

        echo ZExportMenu::widget([
            'dataProvider' => $provider,
            'columns' => $columns,
        ]);

    }

}
