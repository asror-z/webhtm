<?php


use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;


if (!empty($scholar->program))
    if (empty($scholar->status)) {
        $list = Az::$app->App->eyuf->docs->getDocList();
        $scholar->configs->rules = validatorSafe;
        if ($this->modelSave($scholar))
            $this->urlRedirect(['index', true]);

        $count = count($list);
        if ($count > 0)
            echo ZKAlertBlockWidget::widget([
                'config' => [
                    'isUseSessionFlash' => false,
                    'delay' => 2000,
                    'body' => Az::$app->App->eyuf->getDocs()->getDocListHTM($list),
                    'title' => 'asdasd',
                    'alert' => 'asdsadas',
                    'titleOptions' => [
                        'tag' => 'span',
                        'class' => 'kv-alert-title'
                    ],
                ],
            ]);
        else {

            /** @var EyufScholar $scholar */
            $scholar->status = EyufScholar::status['docReady'];
            
            Az::$app->utility->notify->info('Информация', 'У вас есть все необходимые документы.', $scholar->user_id);
            Az::$app->utility->notify->info('Информация', 'Есть новый стипендиант.', 'monitor');
            $scholar->save();
        }
    }
