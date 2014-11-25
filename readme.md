# Socketer

Trying to making a WAMP v2 router for Laravel App.

This project is extended from [voryx/Thruway](https://github.com/voryx/Thruway) and inspired by [sidneywidmer/Latchet](https://github.com/sidneywidmer/Latchet).

## Introduction
Socketer helps you to use Thruway(WAMP v2) Router and Client.
When the router server is started, Laravel also make a Client which run by Laravel itself.

## How to use

Add this code to providers array `app/config/app.php`
```
'LaravelFanatic\Socketer\SocketerServiceProvider'
```

Make `blueprint.php` in `app/` directory.

and write the code like below.
``` php
<?php

// 1) subscribe to a topic
$onevent = function ($args) {
    echo "Event {$args[0]}\n";
};
$session->subscribe('com.myapp.hello', $onevent);

// 2) publish an event
$session->publish('com.myapp.hello', array('Hello, world from PHP!!!'), [], ["acknowledge" => true])->then(
function () {
    echo "Publish Acknowledged!\n";
},
function ($error) {
    // publish failed
    echo "Publish Error {$error}\n";
}
);

// 3) register a procedure for remoting
$add2 = function ($args) {
    return $args[0] + $args[1];
};
$session->register('com.myapp.add2', $add2);

// 4) call a remote procedure
$session->call('com.myapp.add2', array(2, 3))->then(
function ($res) {
    echo "Result: {$res}\n";
},
function ($error) {
    echo "Call Error: {$error}\n";
}
);
```
>This code is cited from [voryx/Thruway](https://github.com/voryx/Thruway).

`$session` is the client session which run by Laravel Client.
and you can find some hint from this package, [Autobahn](
    http://autobahn.ws/js/reference.html#sessions), WAMP Client written in javascript.
