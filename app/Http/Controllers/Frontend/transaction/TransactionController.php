<?php

namespace App\Http\Controllers\Frontend\transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    //  public function __construct(OtherIncomeService $otherIncomeService)
    // {
    //     $this->otherIncomeService = $otherIncomeService;

    // }

    public function index(Request $request)
    {
        $data = [
            'pageTitle' => 'Bills',
           
        ];
        return view('frontend.bill.index', $data);
    }


    public function create(Request $request)
    {
        $data = [

        ];
        return view('frontend.transactions.form', $data);
    }

    public function store(Request $request)
    {
        $this->otherIncomeService->store($request);
        return redirect()->route('bills.index')->with('success', 'Recorded successfully!!');
    }


    public function show($id)
    {
        $data['row'] = Bill::where('id', $id)->first();
        return view('frontend.bill.photoBill', compact('data'));
    }


   

}
