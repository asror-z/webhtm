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


$modelClassName = $this->httpGet('modelClassName');
$query = $this->httpGet('query');

if (empty($modelClassName))
    throw new \InvalidArgumentException('modelClassName required', 403);

$modelClass = $this->bootFull($modelClassName);

Az::$app->office->excel->modelClass = $modelClass;
Az::$app->office->excel->query = $query;
Az::$app->office->excel->run();
