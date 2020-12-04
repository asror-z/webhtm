<?php


use zetsoft\models\App\eyuf\EyufStudent;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;

$action->title = Azl . 'Список student';
$action->icon = 'fa fa-rocket rss';
?>

    <div class="row">
        <div class="col-6">

        </div>
        
        <div class="col-6">
            <?
            $model = new EyufStudent();
            $model->configs->active = EyufStudent::find()->where([
                'eyuf_university_id' =>  1
            ]);

            $model->configs->edits = [
                'fio',
                'name'
            ];

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
            ]);

            ?>
        </div>
    </div>

<?php



