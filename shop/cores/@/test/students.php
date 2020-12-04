<?


use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufStudent;
use zetsoft\models\App\eyuf\EyufUniversity;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZHTML;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\themes\ZCardWidget;

$action->title = Azl . 'TEST APP';

$action->icon = 'fa fa-line-chart';

$id = $this->httpGet('id');

?>


    <div class="row">
        <div class="col-6">

            <?

            if (empty($id))
                echo ZKAlertWidget::widget([
                    'config' => [
                        'title' => Az::l('Problem'),
                        'body' => Az::l('Please add university to ID'),

                    ]
                ]);

            $form = $this->activeBegin();

            ZCardWidget::begin([
                'config' => [
                    'title' => '111111',
                    'icon' => 'fa fa-save',
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);


            $model = EyufUniversity::findOne($id);
            $model->configs->nameOff = [
                'name'
            ];

            /** @var EyufUniversity $model */
            if ($this->modelSave($model))
            {
                $report = EyufReport::findOne([
                    'eyuf_scholar_id' => $model->id
                ]);
                $report->name = $model->name;
                $report->status = $model->count;
                $report->save();

            }
            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ]
            ]);
            
            echo ZHTML::submitButton('save',
                [
                    'class' => 'btn btn-primary'
                ]);

            ZCardWidget::end();

            $this->activeEnd();

            $university = EyufUniversity::find()
                //   ->select(['name', 'departments'])
                ->where([
                    'id' => $id
                ])
                ->limit(1)
                ->one();
            /*            $university->configs->nameOn = [
                            'name',
                            'departments'

                        ];        */
            $university->configs->nameOff = [
                //      'name',
            ];
            echo ZViewWidget::widget([
                'model' => $university,

            ]);





            ?>


        </div>

        <div class="col-6">

            <?
            $model = new EyufStudent();
            $model->configs->query = EyufStudent::find()
                ->where([
                    'eyuf_university_id' => $id
                ]);

            /*    $model->configs->edits = [
                    'name',
                ];*/
            /*          $model->configs->editsEx = [
                          'name',
                      ];*/
            /*            $model->configs->filters = [
                            'name',
                        ];*/
            $model->configs->filtersEx = [
                'name',
            ];
            $model->configs->filter = false;
            $model->configs->edit = true;
            $model->configs->rules = [
                'name' => [[validatorSafe]],
            ];
            $model->configs->rules = [[validatorSafe]];

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $model,
                'config' => [
                    'search' => false,
                    'toolbar' => true,
                    'actionView' => false,
                    'actionEdit' => true,
                    'actionDelete' => false,
                    'actionClone' => false,

                    'columnID' => true,
                    'columnSerial' => true,
                    'columnAction' => true,
                    'columnCheckbox' => true,
                    'columnExpand' => false,
                    'columnFormula' => false,
                    'columnRelation' => true,

                    'topCreate' => true,
                    'topUpdate' => true,
                    'topFilter' => true,
                    'topSort' => true,
                    'topSetting' => true,
                    'topExport' => true,


                    'titleCreate' => '1111',
                    'titleRefresh' => '',
                    'titleDeleteAll' => '',
                    'titleCloneAll' => '',

                    'createUrl' => '/cores/test/add-student.aspx',
                    'updateUrl' => '/logics/monitor/faq.aspx?id=33',

                    'detailUrl' => ['detail'],
                    'deleteUrl' => 'delete',
                    'cloneUrl' => 'clone',
                    'viewUrl' => 'view',


                ]
            ]);

            ?>

        </div>

    </div>

<?php


