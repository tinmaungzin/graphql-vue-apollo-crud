<?php

use App\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserLoginQuery extends Query
{

    protected $attributes = [
        'name' => 'User Login Query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('user'));

    }

    public function args(): array
    {
        return [
            'email' => ['name' => 'email', 'type' => Type::string()],
            'password' => ['name' => 'password', 'type' => Type::string()],

        ];
    }
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::where('email', $args['email'])->first();
        if ($user && Hash::check($args['password'], $user->password)) {
            $user['token'] = $user->createToken('Todo App')->accessToken;
            return $user;
        }
        throw new Exception('Error login');
        return null;
    }
}
