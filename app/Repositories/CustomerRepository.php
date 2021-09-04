<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    function index ($filter)
    {
        $customers = $this->customer->filter($filter)->paginate(5);

        return $customers;
    }

    function countries ()
    {
        // you can use database table of countries or packages,
        // it's not clearfy in task so i will use mockup static data
        return [
            [
                'name' => 'cameroon',
                'code' => '237'
            ],
            [
                'name' => 'ethiopia',
                'code' => '251'
            ],
            [
                'name' => 'morocco',
                'code' => '212'
            ],
            [
                'name' => 'mozambique',
                'code' => '258'
            ],
            [
                'name' => 'uganda',
                'code' => '256'
            ]
        ];
    }

}
