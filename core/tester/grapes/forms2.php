<?


use kartik\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use zetsoft\models\core\CoreInput;
use zetsoft\system\Az;
use zetsoft\widgets\former\ZAjaxWidget;

use yii\web\JsExpression;

use zetsoft\system\actives\ZAjaxForm;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZAjax2Widget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */
//$action = new WebItem();


/*echo "<div class='grDivClass' style='position: relative'>
    <input type='textarea' id='grInput' class='form-control'>
    <input type='hidden' id='myID' class='form-control'>
    <button type='submit' id='grButton' class='btn btn-success '>Change</button>
</div>";*/

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>


<?php


     $ccid = $this->httpGet('ccid');

$widgetClass = str_replace('/', '\\', $this->httpGet('className'));
$model = Az::$app->smart->widget->optionsClass($widgetClass);

$form = ZAjaxForm::begin([
    'id' => 'activeForm',
]);


echo ZButtonWidget::widget([
    'id' => 'sendOptions',
    'config' => [
        'text' => 'Сохранить',
        'icon' => 'fas fa-' . FA::_USER,
        'btnType' => ZButtonWidget::btnType['button'],
        'btnStyle' => ZButtonWidget::btnStyle['btn-primary'],
        'class' => 'text-white'
    ],
]);

echo ZFormWidget::widget([
    'config' => [
        'topBtn' => false,
        'botBtn' => false,
    ],
    'model' => $model,
    'form' => $form,
]);

ZAjaxForm::end();

?>

<script>
    var inputs = $('input[type=text]');

    inputs.on('change', function () {
         $('#sendOptions').click();
    });



   /* $(document).on('click', '#sendOptions', function() {
        $.ajax({
            type: 'GET',
            url: '/core/widget/widget2.aspx?' + $('#activeForm').serialize() + '&widget=<?=$widgetClass?>,
            success: function(response) {


                /!* console.log(e);      *!/
                e.set(response);
            },
        });
    });*/

    $('#activeForm').change(function() {
        $('#sendOptions').click();
    });


</script>
