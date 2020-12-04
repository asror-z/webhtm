<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

$startRange = $this->sessionGet('rangeDatePeriod');

$form = $this->ajaxBegin();
$app = new ALLApp();

$column = new Form();
$column->dbType = dbTypeDate;
$column->widget = ZHHiddenInputWidget::class;
$app->columns['start'] = $column;

$column = new Form();
$column->dbType = dbTypeDate;
$column->widget = ZHHiddenInputWidget::class;
$app->columns['end'] = $column;

$column = new Form();
$column->title = 'form_id';
$column->widget = ZPeriodPickerWidget::class;
$column->options = [
    'config' => [
        'valueStart' => 'start',
        'valueEnd' => 'end',
    ],
    'value' =>$startRange,
];



$app->columns['period'] = $column;

$model_d = Az::$app->forms->former->model($app);






$post = $this->httpPost('ZDynamicModel');


$period= ZArrayHelper::getValue($post, 'period');
if ($post !== null) {
    $dateBegin = $period[0];
    $dateEnd = $period[1];

    $this->sessionSet('rangeDatePeriod',$period);
    $this->urlRedirect(['/supervisor/main/index'],true);

}

if($startRange) {
    $beginDate = $this->sessionGet('rangeDatePeriod')[0];
    $endDate = $this->sessionGet('rangeDatePeriod')[1];


    if ($beginDate && $endDate) {
        $model->configs->query = ShopOrder::find()->where(['between', 'created_at', $beginDate, $endDate]);
    }
}

?>


<?




/*$users = [];
$operators = Az::$app->market->operator->getUserByRole('agent');

$firstSelect = null;
if (!empty($operators)) {
    $firstSelect = $operators[0]['id'];

    foreach ($operators as $operator)
        $users[$operator['id']] = $operator['name'];

} else {
    echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
}*/

?>

    <div id="content" class="content-footer p-3">

    <script>
        var agentId = <?=$firstSelect?>;
    </script>


    <div class="row">
        <div class="col-md-12 d-flex mt-n2 pt-0">
        <?= ZFormWidget::widget([
            'model' => $model_d,
            'form' => $form,
            'config' => [
                'topBtn' => false,
                'botBtn' => false,
            ],


        ]); ?>

        <?= ZButtonWidget::widget([
            'config' => [
                'btnRounded' => false,
                'btnType' => ZButtonWidget::btnType['submit'],
                'text' => Az::l('Филтровать'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'btnSize' => 'btn-ml',
                'class' => 'p-1 mx-1'
            ]
        ]);
        ?>


        <?= ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Очистить филтр'),
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'btnType' => ZButtonWidget::btnType['submit'],
                'btnRounded' => false,
                'btnSize' => 'btn-ml',
                'class' => 'p-1 mx-1'

            ],
            'event' => [
                'click' => <<<JS
                                              
            
                  function() {
            
                          $.ajax({
                              type: 'POST',
                              url: '/core/product/rangeClear.aspx',
            
                              success: function (response) {
                                  location.reload();
                              },
                          });
                      
                  }
        JS
            ]
        ]);
        $this->ajaxEnd();
        ?>
        </div>
    </div>
