<?php

namespace App\Services\System;


use App\Model\Customer;
use App\Model\Order;
use App\Services\Service;

class CustomerService extends Service
{

     protected $orderService,$frontendUser;
    public function __construct(Customer $customer)
    {
        
        parent::__construct($customer);
        $this->orderService = new OrderService(new Order);

        $this->module = 'Prepare Bill';
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {  
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%'.$data->keyword.'%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if ($pagination) {
            return $query->orderBy('created_at', 'DESC')->paginate(PAGINATE);
        }
        // return $query->orderBy('created_at', 'DESC')->get();
    }

    public function store($request)
    {
        return $this->model->create($request->except('_token'));
    }

  

        

    public function getCustomerId($request){
        $query = $this->query();
        return $query->where('phone_number',$request->phone_number)->first()->id ?? null;

    }


    public function createPageData($request){
       
        return[
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'users'=>$this->frontendUser->getAllData($request),
            'status'=>$this->status(),
            'order_id'=>$request->order_id,
            'pageTitle'=>$this->module,
            
        ];
        
    }


    public function editPageData($request, $id)
    {
        return[
            'item' => $this->itemByIdentifier($id),
            'orders' => $this->orderService->getAllData($request->merge(['pluck'=>true])),
            'status'=>$this->status(),
            'order_id'=>$request->order_id,
        ];
    }
       


    public function indexPageData($request){
        return[
            'items' => $this->getAllData($request),
            'order_id'=>$request->order_id,
        ];
    }

    

   
}
