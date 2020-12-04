<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

/*use zetsoft\models\user\UserCompany;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget2;

$model = new UserCompany();

echo ZHInputWidget::widget([
    'model' => $model,
    'attribute' => 'title',
    'config' => [
        'hasPlace' => true
    ]
]);
echo ZInputWidget::widget([
    'model' => $model,
    'attribute' => 'title',
    'config' => [
        'hasPlace' => true
    ]
]);*/
?>
<?php

use zetsoft\models\drag\DragApp;
use zetsoft\models\user\User;
use zetsoft\models\test\Test5;
use zetsoft\system\Az;
use zetsoft\models\test\Test3;
use zetsoft\service\search\TntSearchService;

class test
{

    public $control;

    public $action;

    public $data;

    public $json;

    public $res;

    public $modal;

    public $classes;

    public function __construct()
    {
        $this->json = $_GET['json'] ?? '';
        if (isset($this->json)) {
            $this->data = json_decode($this->json, true);
        }
        $this->control = new TntSearchService();
        $this->chooseModal();
        if (isset($this->data)) {
            $this->carryOn();
        } else {
            echo 'Invalid Params';
        }
    }

    public function chooseModal()
    {
        //$this->classes = Az::$app->smart->migra->scan();
        $this->classes = [
            Test5::class,
            Test3::class,
            User::class,
            DragApp::class
        ];
        $givenName = strtolower($this->data['name']);
        foreach ($this->classes as $class) {
            $class::find()->all();
            $name = strtolower(bname($class));
            if ($name === $givenName) {
                $this->modal = new $class();
            }
        }

    }

    public function normalize()
    {
        $arr = preg_split('/(?=[A-Z])/', $this->control->name);
        if (count($arr) !== 1) {
            $this->control->name = '';
            $max = count($arr);
            for ($i = 1; $i < $max; $i++) {
                if ($i < count($arr) - 1) {
                    $this->control->name .= $arr[$i] . '_';
                } else {
                    $this->control->name .= $arr[$i];
                }
            }
        }
        $this->control->name = strtolower($this->control->name);
    }

    public function carryOn()
    {
        $this->control->name = $this->data['name'];
        $this->normalize();
        if ($this->data[paramAction] === 'search') {
            $this->search();
        } else if ($this->data[paramAction] === 'update') {
            $this->update();
        }
    }

    public function update()
    {
        $this->control->query = 'SELECT * FROM ' . $this->control->name;
        $this->control->createIndexService();
        var_dump($this->control->result);
    }

    public function search()
    {
        if (!empty($this->data['search'])) {
            $this->control->shouldHave = $this->data['search'];
        }
        if (!empty($this->data['shouldNotHave'])) {
            $this->control->shouldNotHave = $this->data['shouldNotHave'];
        }
        $this->control->booleanSearch();
        $this->res = $this->control->result['ids'];
        if (empty($this->res)) {
            echo 'No Results Found';
        } else {
            $this->res = $this->modal::findBySql("SELECT * FROM " . $this->control->name . " WHERE id IN (" . implode(",", array_map('intval', $this->res)) . ")")->all();
            require __DIR__ . '\SearchTable.php';

        }
    }
}

$test = new test();



