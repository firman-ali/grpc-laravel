<?php

use App\Grpc\Greeter\GreeterInterface;
use App\Services\GreeterService;
use Spiral\RoadRunner\GRPC\Invoker;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\Worker;

require __DIR__ . '/vendor/autoload.php';

$server = new Server(new Invoker(), [
    'debug' => false,
]);

$server->registerService(GreeterInterface::class, new GreeterService());

$server->serve(Worker::create());