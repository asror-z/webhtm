  <?php
  use Illuminate\Support\Collection;
  use yii\base\ErrorException;
  use zetsoft\dbitem\data\ALLApp;
  use zetsoft\dbitem\data\Config;
  use zetsoft\dbitem\data\Form;
  use zetsoft\dbitem\shop\CompanyCardItem;
  use zetsoft\dbitem\shop\MultiProductItem;
  use zetsoft\dbitem\shop\ProductItem;
  use zetsoft\dbitem\shop\PropertyItem;
  use zetsoft\dbitem\shop\SingleProductItem;
  use zetsoft\models\shop\ShopBrand;
  use zetsoft\models\shop\ShopCatalog;
  use zetsoft\models\shop\ShopCategory;
  use zetsoft\models\shop\ShopElement;
  use zetsoft\models\shop\ShopOption;
  use zetsoft\models\shop\ShopOptionBranch;
  use zetsoft\models\shop\ShopOptionType;
  use zetsoft\models\shop\ShopProduct;
  use zetsoft\models\shop\ShopShipment;
  use zetsoft\models\user\UserCompany;
  use zetsoft\service\forms\Ajaxer;
  use zetsoft\system\assets\ZColor;
  use zetsoft\system\Az;
  use zetsoft\system\helpers\ZArrayHelper;
  use zetsoft\system\helpers\ZUrl;
  use zetsoft\system\kernels\ZFrame;
  use zetsoft\widgets\actions\ZEasySelectableWidget;
  use zetsoft\widgets\former\ZFormWidget;
  use zetsoft\widgets\images\ZImageWidget;
  use zetsoft\widgets\incores\ZIRadioGroupWidget;
  use zetsoft\widgets\incores\ZMCheckboxGroupWidget;
  use zetsoft\widgets\incores\ZMRadioWidget;
  use zetsoft\widgets\inputes\ZHInputWidget;
  use zetsoft\widgets\inputes\ZKSliderIonWidget;
  use zetsoft\widgets\inputes\ZSelect2Widget;
  use zetsoft\widgets\navigat\ZGAccordionWidget;
  use zetsoft\widgets\navigat\ZMarketDropdownWidget;
  use zetsoft\widgets\values\ZFormViewWidget;
  use function Spatie\array_keys_exist;

$column = new Form();
$brand_data = [];
$allBrands = [
      "TomFord.png",
      "bmw.jpg",
      "huawei.jpg",
      "TommyHilfiger.png",
      "gucci.png",
      "levis.png",
      "mercedesbenz.jpg",
      "lg.png",
      "lg.jpg",
      "HP-logo-2010–2012.jpg",
      "samsung.jpg",
      "asus-6630.svg",
      "apple.jpg",
      "acer.jpg",
      "lenov.png",
      "xiaomi-Mi-red-banner-800x450.jpg",
      "xiaomi-Mi-red-banner-800x450.jpg",
  ];


foreach ($allBrands as $brand) {
$brand_data[$brand] = ZImageWidget::widget([
'config' => [
'url' => '/uploaz/' /*. App*/ . '/ShopBrand/image/' /*. $brand->id . '/' */ . $brand,
'class' => "ml-20",
'width' => '90%',
]
]);
}

$column->widget = ZMarketDropdownWidget::class;
$column->options = [
'config' => [
'accordion' => true,
'content' => ZEasySelectableWidget::widget([
'data' => $brand_data,
'config' => [
'class' => "d-flex",
'cols' => ZEasySelectableWidget::cols['3'],
],
'name' => 'brand',

//'value' => ['19'],
/*  'config' => [
'container' => 'brandCheckBox'
]*/
]),
'title' => Az::l('Марка')
]
];

$app->columns['brand'] = $column;
$item = new ProductItem();
//$currency = ZProductItem::
$column = new Form();
$column->widget = ZKSliderIonWidget::class;
$column->options = [
'name' => 'price_filter',
'config' => [
'type' => 'double',
'skin' => 'modern',
'min' => '12$',
'max' => '12000$',
'from' => '12$',
'to' => '12000$',
//'postfix' => " $",
'inputs_show' => true,
'title' => "Цена в ($item->currency)",
],
];
$app->columns['price'] = $column;





$content = '';
foreach ($category as $key => $property) {
//vdd($property->items);
$content .= ZGAccordionWidget::widget([
'config' => [
'content' => ZMCheckboxGroupWidget::widget([
'data' => $property->items,
'name' => "ZDynamicModel[]",
'value' => rand(0,10),
'config' => [
'class' => 'optionCheckBoxes',
'textColor' => ZColor::color['black'],
]
]),
'title' => $property->name,
'class' => ''
]
]);
}
$column = new Form();
$column->widget = ZMarketDropdownWidget::class;
$column->options = [
'config' => [
'content' => $content,
'title' => $branch->name,
'class' => '',
'onlyOneActive' => 0,
'initFirstActive' => 0,
'hideControl' => true,
'openNextOnClose' => true
]
];
//$column->data = $property->items;



$column = new Form();
$column->widget = ZHInputWidget::class;
$column->options = [
'name' => 'category_id',
'value' => $category_id,
'config' => [
'type' => ZHInputWidget::type['hidden'],
]
];
$app->columns['hidden_input'] = $column;

$app->cards = [];

return Az::$app->forms->former->model($app);




  $active = new Ajaxer();
  $active->id = 'activeFormCheck';
  $active->showLabels = false;

  $form = $this->ajaxBegin($active);
  $models = Az::$app->smart->widget->getFilterbrands();

  foreach ($models as $title => $model) {
      echo ZMarketDropdownWidget::widget([
          'config' => [
              'title' => $title,
              'content' => ZFormWidget::widget([
                  'model' => $model,
                  'form' => $form,
                  'config' => [
                      'topBtn' => false,
                      'botBtn' => false,
                  ],
              ]),
          ],
          'event' => [
              'formChange' => <<<JS
                                function (event) {
                                e.preventDefault();    
                             $('#sendValues').click();
                                //$.pjax.reload({container:'#activeFormCheck'});
                          }
JS

          ]
      ]);
  }
