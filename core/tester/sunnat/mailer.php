<?php

use zetsoft\models\user\User;
use zetsoft\system\kernels\ZView;

//  $data = Az::$app->App->eyuf->main->mailer();
/** @var ZView $this */
//  $s = Root.'/core/tester/webhtm/sunnat/tomail.php';

$contentUrl = "";
$subject = "";
$user = User::findOne( ['id' => 29] );
Az::$app->utility->mails->run( $user, $contentUrl, $subject );

/*
 *
     \Yii::$app->mailer->htmlLayout = "layouts/custom_html";
     \Yii::$app->mailer->compose("view");
 *
 */
