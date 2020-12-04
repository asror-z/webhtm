<?


use phpDocumentor\Reflection\Types\This;
use rmrevin\yii\fontawesome\FA;
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


$widgetClass = $this->httpGet('className');
$widgetClass = str_replace('/', '\\', $widgetClass);
$model = Az::$app->smart->widget->options($widgetClass);

$form = $this->activeBegin();

echo ZFormWidget::widget([
    'config' => [
        'topBtn' => false,
        'botBtn' => false,

    ],

    'model' => $model,
    'form' => $form,
]);

echo ZButtonWidget::widget([
    'id' => 'secondary' . $this->id,
    'config' => [
        'btnType' => ZButtonWidget::btnType['button'],
        'text' => Az::l('Сохранить'),
        'pjax' => 0,
        'icon' => 'fa fa-' . FA::_SAVE,
        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
        'btnRounded' => true,
        'name' => 'submitBtn'
    ],
    'event' => [
        'click' => ajax2(),
    ]

]);

$this->activeEnd();


echo ZAjaxWidget::widget([
    'config' => [
        'func' => 'ajax1',
        'url' => '/core/widgettest/widget.aspx',
        'type' => ZAjaxWidget::type['get'], // "POST", "GET", "PUT"
        'data' => [
            'widgetClass' => $widgetClass,
            'options' => json_encode($this->httpPost('ZDynamicModel'))
        ]
    ],
    'event' => [
        'complete' => <<<JS
        function(data) {
            $('#widget').html(data.responseText);
        }
JS,]
]);

?>

<script>
    var inputs = $('input[type=text]');
    inputs.on('change', function () {
        $('#secondary').click();
    });
</script>
