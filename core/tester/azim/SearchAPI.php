<?php

use zetsoft\models\test\Test5;
use zetsoft\service\search\TntSearchService;

class SearchAPI
{

    public $control;

    public $action;

    public $data;

    public $json;

    public $res;

    public $modal;

    public function __construct()
    {
        $this->json = $_POST['json'] ?? '';
        if (isset($this->json)) {
            $this->data = json_decode($this->json, true);
        }
        $this->control = new TntSearchService();
        $this->modal = new Test5();
        if (isset($this->data)) {
            $this->carryOn();
        } else {
            echo 'Invalid Params';
        }
    }

    public function carryOn()
    {
        $this->control->name = $this->data['name'];
        $this->control->search = $this->data['search'];
        $this->control->regularSearch();
        $this->res = $this->control->result['ids'];
        $this->dbSearch();
    }

    public function dbSearch()
    {
        $this->res = $this->modal::findBySql("SELECT * FROM test5 WHERE id IN (" . implode(",", array_map('intval', $this->res)) . ")")->all();
        require __DIR__ . '\SearchTable.php';
    }
}

$test = new SearchAPI();
