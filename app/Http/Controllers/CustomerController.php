<?php

namespace App\Http\Controllers;

use App\Http\Filters\CustomerFilter;
use App\Http\Resources\CustomerResource;
use App\Repositories\CustomerRepository;
use App\Traits\ApiPaginator;
use App\Traits\RESTApi;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
{
    use RESTApi, ApiPaginator;

    private $customerRepository;

    public function __construct(CustomerRepository $repository)
    {
        $this->customerRepository = $repository;
    }

    public function index (CustomerFilter $filter)
    {
        $customers = $this->customerRepository->index($filter);

        $collection = CustomerResource::collection($customers);

        return $this->sendJson($this->getPaginatedResponse($customers, $collection));
    }

    public function countries ()
    {
        $countries = $this->customerRepository->countries();

        return $this->sendJson($countries);
    }
}
