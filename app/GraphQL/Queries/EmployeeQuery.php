<?php

namespace App\GraphQL\Queries;

use App\Employee;
use Closure;

use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class EmployeeQuery extends Query
{
    protected $attributes = [
        'name' => 'employees query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('employee'));

    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Employee::where('id' , $args['id'])->get();
        }




        return Employee::all();
    }
}
