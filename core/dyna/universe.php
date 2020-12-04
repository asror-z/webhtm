<?php

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

/*
    $model = new EyufScholar();
    $queryss = EyufScholar::find()
        ->where(['not',
            ['status' => 123]
        ])
        ->andWhere(['not',
            ['status' => null]
        ]);*/


use zetsoft\system\Az;

$modelClassName = $this->httpGet('modelClassName');
//        $query = $this->httpGet('query');
$query = ZVarDumper::cleanEmpty($this->httpGet($modelClassName));

if (empty($modelClassName))
    throw new \InvalidArgumentException('modelClassName required', 403);

$modelClass = $this->bootFull($modelClassName);

Az::$app->utility->excel->modelClass = $modelClass;
Az::$app->utility->excel->query = $query;
Az::$app->utility->excel->run();
