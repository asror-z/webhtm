<?php

use zetsoft\service\calls\MarceAMI;

class Api
{
//    private $action = null;
    private $props;
    private $callAction;
    private $control;

    public function __construct()
    {
        $this->control = new MarceAMI();
    }

    public function check()
    {
        $this->callAction = $_GET[paramAction];
//        $this->callAction = 'dial';


//        $json = $_POST['props'];
//        $this->props = json_decode($json);
        $this->act();
//        $this->test();
    }

    public function act()
    {
        if ($this->callAction === 'dial') {
            $this->control->ext = '204';
            $this->control->originate();
//            $this->control->sipPeers();
//            $this->control->loopRun();
            $this->control->close();
            echo 'Dial';
        }
    }

    public function test()
    {
        echo 'Hello';
    }
}
$test = new Api;
$test->check();
