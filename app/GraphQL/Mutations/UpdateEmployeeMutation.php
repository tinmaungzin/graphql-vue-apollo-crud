<?php

namespace App\GraphQL\Mutations;

use App\Employee;
use App\User;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class UpdateEmployeeMutation extends Mutation
{
    protected $attributes = [
        'name' => 'update employee'
    ];

    public function type(): Type
    {
        return GraphQL::type('employee');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int(),'rules'=> ['required']],
            'name' => ['name' => 'name', 'type' => Type::string(),'rules'=> ['required']],
            'email' => ['name' => 'email', 'type' => Type::string(),'rules' => ['required','email']],
            'phone' => ['name' => 'phone', 'type' => Type::string(),'rules' => ['required']],
            'address' => ['name' => 'address', 'type' => Type::string(),'rules' => ['required']],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $employee = Employee::find($args['id']);
        if(!$employee) {
            return null;
        }


        $employee->name = $args['name'];
        $employee->email = $args['email'];
        $employee->phone = $args['phone'];
        $employee->address = $args['address'];
        $employee->save();
        return $employee;
    }
}
