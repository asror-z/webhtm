<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use kartik\detail\DetailView;
use zetsoft\models\App\eyuf\EyufDocumentType;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWizardWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Просмотр  Типы Документов';
$action->icon = 'fa fa-cloud-download';

$id = $this->httpGet('id');


?>

<div class="col-lg-6">
    <iframe src="/core/tester/iframe/content.aspx"></iframe>
</div>
