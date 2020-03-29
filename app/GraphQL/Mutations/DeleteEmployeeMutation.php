<?php

namespace App\GraphQL\Mutations;

use App\Employee;
use Closure;
use GraphQL;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class DeleteEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Delete Employee'
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::int())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::find($args['id']);
        if(!$employee) {
            return null;
        }

        $employee->delete();

        return $employee;
    }
}
