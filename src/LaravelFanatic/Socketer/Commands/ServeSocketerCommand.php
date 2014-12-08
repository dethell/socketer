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
        $socketer = \App::make('LaravelFanatic\Socketer\Socketer');

        $loop = \React\EventLoop\Factory::create();

        //$loop->addTimer(2, array($manager, "testSubscribe"));

        $router = new Router($loop);

        $transportProvider = new RatchetTransportProvider("127.0.0.1", 9090);

        $internalClientTransportProvider = new \Thruway\Transport\InternalClientTransportProvider($socketer);

        $router->addTransportProvider($transportProvider);
        $router->addTransportProvider($internalClientTransportProvider);

        $router->start();
    }

}
