<?php

namespace App\Grpc\Controllers;

use Protobuf\Identity\AuthServiceInterface;
use Protobuf\Identity\Response;
use Protobuf\Identity\SignInRequest;
use App\Grpc\Contracts\Validator;
use Illuminate\Contracts\Hashing\Hasher;
use Spiral\GRPC\Exception\InvokeException;
use Spiral\GRPC\StatusCode;
use Protobuf\Identity\SignUpRequest;
use Throwable;
use Spiral\GRPC\ContextInterface;

class AuthController implements AuthServiceInterface
{
    /**
     * Input validator
     *
     * @var Validator
     */
    protected Validator $validator;

    /**
     * Hasher
     *
     * @var Hasher
     */
    protected Hasher $hasher;

    /**
     * Create new instance.
     *
     * @param  Validator $validator
     * @param  Hasher $hasher
     */
    public function __construct(Validator $validator, Hasher $hasher)
    {
        $this->validator = $validator;
        $this->hasher = $hasher;
    }

    /**
     * @param ContextInterface $ctx
     *
     * @param  SignUpRequest $request
     * @return Response
     * @throws Throwable
     */
    public function SignUp(ContextInterface $ctx, SignUpRequest $request): Response
    {
        $data = json_decode($request->serializeToJsonString(), true);

        $this->validator->validate($data, [
            'email' => 'bail|required|email',
            'name' => 'required|max:255',
            'password' => 'required|confirmed',
        ]);

        $response = new Response();

        $response->setId(1);
        $response->setToken("token"); //TODO use jwt to handle token base auth

        return $response;
    }

    /**
     * @param ContextInterface $ctx
     * @param SignInRequest $in
     * @return Response
     * @throws Throwable
     */
    public function SignIn(ContextInterface $ctx, SignInRequest $in): Response
    {
        $data = json_decode($in->serializeToJsonString(), true);

        $this->validator->validate($data, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

//        if (!$this->hasher->check($data['password'], '123123')) {
//            throw new InvokeException("credentials error: ", StatusCode::INVALID_ARGUMENT);
//        }

        $response = new Response();

        $response->setId("1");
        $response->setToken("token"); //TODO using jwt to handle token base auth

        return $response;
    }
}
