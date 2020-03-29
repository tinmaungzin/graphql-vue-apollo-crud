<?php

namespace App\GraphQL\Mutations;

use App\Employee;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'employee name',
        'email' => 'employee email',
        'phone' => 'employee phone',
        'address' => 'employee address',
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string(),'rules'=>['required']],
            'email' => ['name' => 'email', 'type' => Type::string(),'rules'=>['required','email']],
            'phone' => ['name' => 'phone', 'type' => Type::string(),'rules'=>['required']],
            'address' => ['name' => 'address', 'type' => Type::string(),'rules'=>['required']],

        ];
    }



    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'phone' => $args['phone'],
            'address' => $args['address'],

        ]);

        return $employee;
    }
}
