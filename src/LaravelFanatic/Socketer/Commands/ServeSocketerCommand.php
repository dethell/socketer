<?php namespace LaravelFanatic\Socketer\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;


class ServeSocketerCommand extends Command{
    /**
    * The console command name.
    *
    * @var string
    */
    protected $name = 'socketer:serve';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Serve Socketer';

    /**
    * Create a new command instance.
    *
    * @return void
    */

    protected $socketer;

    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function fire()
    {
        $port = $this->option('port');
        $address = $this->option('ip_address');
        
        $socketer = \App::make('LaravelFanatic\Socketer\Socketer');

        $loop = \React\EventLoop\Factory::create();

        //$loop->addTimer(2, array($manager, "testSubscribe"));

        $router = new Router($loop);

        $transportProvider = new RatchetTransportProvider($address, $port);

        $internalClientTransportProvider = new \Thruway\Transport\InternalClientTransportProvider($socketer);

        $router->addTransportProvider($transportProvider);
        $router->addTransportProvider($internalClientTransportProvider);

        $router->start();
    }
    
    public function getOptions()
    {
        return [
	       ['ip_address', 'i', InputOption::VALUE_OPTIONAL, 'IP Address', '127.0.0.1'],
	       ['port', 'p', InputOption::VALUE_OPTIONAL, 'TCP Port', '9090'],
        ];
    }

}
