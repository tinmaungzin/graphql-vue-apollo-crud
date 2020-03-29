<?php

namespace App\GraphQL\Queries;

use App\Employee;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class EmployeesQuery extends Query
{
    protected $attributes = [
        'name' => 'Employee query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('employee');

    }

    public function args(): array
    {
        return [
            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if(isset($args['limit'], $args['page'])){
            return Employee::paginate($args['limit'], ['*'], 'page', $args['page']);
        }

        return Employee::all();
    }
}
