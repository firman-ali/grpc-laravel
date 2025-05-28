<?php

ini_set('display_errors', 'stderr');
require __DIR__.'/vendor/autoload.php';

use App\Grpc\Greeter\GreeterInterface;
use App\Services\GreeterService;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\GRPC\Invoker;   // <-- TAMBAHKAN INI
use Spiral\RoadRunner\Worker;
use Illuminate\Contracts\Container\Container;

// Bootstrap Laravel
/** @var Container $app */
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Buat GRPC Server DENGAN Invoker
$server = new Server(new Invoker(), ['debug' => env('APP_DEBUG', false)]); // <-- UBAH BARIS INI

// Daftarkan service Anda
$server->registerService(
    GreeterInterface::class,
    $app->make(GreeterService::class)
);

// Jalankan worker
$w = Worker::create();
$server->serve($w);