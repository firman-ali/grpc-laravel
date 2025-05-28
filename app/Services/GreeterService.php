<?php

namespace App\Services;

use App\Grpc\Greeter\GreeterInterface;
use App\Grpc\Greeter\HelloRequest;
use App\Grpc\Greeter\HelloReply;
use Spiral\RoadRunner\GRPC\ContextInterface;

class GreeterService implements GreeterInterface
{
    public function SayHello(ContextInterface $ctx, HelloRequest $request): HelloReply
    {
        $reply = new HelloReply();
        $reply->setMessage("Hello, " . $request->getName() . " from Updated Laravel!");

        return $reply;
    }
}