<?php

namespace LaravelFanatic\Socketer;

use Thruway\Peer\Client;

class Socketer extends Client{

    protected $blueprint;
    /**
    * Contructor
    */
    public function __construct(Blueprint $blueprint)
    {
        parent::__construct("realm1");
        $this->blueprint = $blueprint;
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
        $blueprint = $this->getBlueprint();
        eval($blueprint);
    }

    public function getBlueprint(){
        $blueprint = $this->blueprint->load();
        return $blueprint;
    }

}
