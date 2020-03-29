<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'LoginMutation',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'username' => ['name' => 'username', 'type' =>Type::string(),'rules' => ['required']],
            'password' => ['name' => 'password', 'type' =>Type::string(),'rules' => ['required']],
        ];
    }

    public function resolve($root, $args)
    {
        $credentials = [
            'client_id' => 4,
            'client_secret' => 'XERBZMCQ7Qv7ihTdnvZI2tpuGQ7uht7MfpecfMph',
            'grant_type' => 'password',
            'username' => $args['username'],
            'password' => $args['password']
        ];
//        return $credentials;
        $token = $this->makeRequest($credentials);
        return $token;
    }

    public function makeRequest(array $credentials)
    {
        $request = Request::create('oauth/token', 'POST', $credentials,[], [], [
            'HTTP_Accept' => 'application/json'
        ]);
        $response = app()->handle($request);
        $decodedResponse = json_decode($response->getContent(), true);
        if ($response->getStatusCode() != 200) {
            throw new AuthenticationException($decodedResponse['message']);
        }
        return $decodedResponse;
    }
}
