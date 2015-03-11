<?php

namespace LaravelFanatic\Socketer;

use Thruway\Peer\Client;

class Socketer extends Client{

    protected $blueprint;
    /**
    * Contructor
    */
    public function __construct($realm)
    {
        parent::__construct($realm);
    }

    public function start(){
    }
    public function onSessionStart($session, $transport)
    {
        // TODO: now that the session has started, setup the stuff
        echo "Laravel is online";
        $this->drill($session);
    }

    public function drill($session){
        require app_path().'/blueprint.php';
    }

}
