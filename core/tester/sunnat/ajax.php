<?php

use zetsoft\models\user\User;

$q = $this->httpGet('q');
$out = ['results' => ['id' => '', 'text' => '']];
$data = User::find()
    ->select('id, name AS text')
    ->asArray()
    ->where(['LIKE', 'name', $q])
    ->all();
$out['results'] = $data;

return [['id'=>'1','name'=>'sdfsdf'],['id'=>'2','name'=>'fsdfsdf']];
















