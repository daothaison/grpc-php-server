<?php

use Spiral\RoadRunner\Worker;
use Spiral\Goridge\StreamRelay;

ini_set('display_errors', 'stderr');

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$app->singleton(
    App\Grpc\Contracts\Kernel::class,
    App\Grpc\Kernel::class
);

$app->singleton(
    App\Grpc\Contracts\ServiceInvoker::class,
    App\Grpc\LaravelServiceInvoker::class
);

$kernel = $app->make(App\Grpc\Contracts\Kernel::class);

$kernel->registerService(Protobuf\Identity\AuthServiceInterface::class);

$w = new Worker(new StreamRelay(STDIN, STDOUT));

$kernel->serve($w);
