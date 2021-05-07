<?php
# Generated by the protocol buffer compiler (spiral/php-grpc). DO NOT EDIT!
# source: protos/auth.proto

namespace Protobuf\Identity;

use Spiral\GRPC;

interface AuthServiceInterface extends GRPC\ServiceInterface
{
    // GRPC specific service name.
    public const NAME = "protobuf.identity.AuthService";

    /**
    * @param GRPC\ContextInterface $ctx
    * @param SignInRequest $in
    * @return Response
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function SignIn(GRPC\ContextInterface $ctx, SignInRequest $in): Response;

    /**
    * @param GRPC\ContextInterface $ctx
    * @param SignUpRequest $in
    * @return Response
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function SignUp(GRPC\ContextInterface $ctx, SignUpRequest $in): Response;
}
