<?php
namespace App\GraphQL\Types;

use App\Employee;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EmployeeType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Employee',
        'description'   => 'A employee',
        'model'         => Employee::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the employee',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()) ,
                'description' => 'The name of employee',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()) ,
                'description' => 'The email of employee',
            ],
            'phone' => [
                'type' => Type::nonNull(Type::string()) ,
                'description' => 'The phone number of employee',
            ],
            'address' => [
                'type' => Type::nonNull(Type::string()) ,
                'description' => 'The address of employee',
            ],



        ];
    }
}
