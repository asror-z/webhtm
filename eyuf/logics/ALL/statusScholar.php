<?php


use zetsoft\models\App\eyuf\EyufDocument;

$statusDoc = EyufDocument::find()
    ->where([
        'status' => true
    ])
    ->all();



