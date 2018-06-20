<?php

require_once __DIR__ . '/api.php';
require_once __DIR__ . '/models/shipment.php';

class EndPoint extends API{

    public function __construct($request,$origin)
    {
        parent::__construct($request);
    }
    protected function example(){
        return array("endPoint"=>$this->endpoint,"verb"=>$this->verb,"args"=>$this->args,"request"=>$this->request);
    }
    protected function shipment(){
        $data = null;
        if($this->method == 'GET' && isset($this->verb)){
            $data = new Shipment($this->verb);
        }elseif($this->method == 'GET' && !isset($this->verb)){
            $data = Shipment::get("status_id",1,"active");
        }elseif($this->method == 'POST' && !isset($this->verb)){
            throw new \Exception('Cannot POST here.');
        }elseif($this->method == 'PUT' && isset($this->verb)){
            $data = new Shipment($this->verb);
            $data->setFields($this->file)->update();
        }else{
            throw new \Exception('Unsupported request');
        }
        return $data;
    }

}