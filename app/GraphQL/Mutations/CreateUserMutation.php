<?php

namespace App\GraphQL\Mutations;

use Closure;
use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'user name',
        'email' => 'user email',
        'password' => 'user password'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string(),'rules'=>['required']],
            'email' => ['name' => 'email', 'type' => Type::string(),'rules'=>['required','email']],
            'password' => ['name' => 'password', 'type' => Type::string(),'rules'=>['required']]

        ];
    }



    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['name']) ,

        ]);

        return $user;
    }
}
