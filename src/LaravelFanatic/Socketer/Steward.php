<?php

namespace LaravelFanatic\Socketer;

use Thruway\Manager\ManagerClient;

class Steward extends ManagerClient{

    /**
    * Contructor
    */
    public function __construct()
    {
        parent::__construct("realm1");
    }

    public function start(){
        echo "Yeo";
    }

}
