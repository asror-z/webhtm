<?php


class Main
{
    /**
     * @var string Urls 
     */
    public $mainUrl = 'http://arbit.zetsoft.uz/api/cpas/lead/create-lead.aspx';
    
    public $tanksUrl = "thanks.html";

    /**
     * @var replace Vars
     */
    public $offer_id;
    public $subId;
    public $customer;
    public $tel;
    public $amount;
    public $item_id;

    public function __construct()
    {
        
    }

    public function release()
    {
        $landingUrl = __DIR__ . '/landing.html';
        if (!file_exists($landingUrl))
            return false;

        $this->landing = file_get_contents($landingUrl);

//        $return = strtr($this->landing, [
//            '{offer_id}' => $this->offer_id,
//            '{subId}' => $this->getId(),
//        ]);

        return $this->landing;
    }


    public function getId()
    {
        if (empty($_GET))
            return null;

        $subId = $_GET['subId'];
        if (!empty($subId)) {
            return $subId;
        }
    }


    public function post()
    {
        if (!empty($_POST)) {

            $this->customer = urlencode($_POST['name']);
            $this->tel = urlencode($_POST['number']);
            $this->amount = urlencode($_POST['amount']);

            $params = array(
                'offer_id' => $this->offer_id,
                'name' => $this->customer,
                'phone_number' => $this->tel,
                'amount' => $this->amount,
                'subId' => $this->subId,
                'item_id' => $this->item_id
            );
            //$this->vdd($params);
            $return = $this->goCurl($params);
            //$this->vdd($return);
            $this->redirect();
        }
    }

    public function redirect()
    {
        return header("Location: $this->tanksUrl");
    }

    public function refresh()
    {
        header("Refresh : 0");
    }


    function goCurl($data)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->mainUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $return = curl_exec($ch);

        curl_close($ch);

        return $return;

    }

    public function vdd($var)
    {
        var_dump($var);
        die;
    }

}
