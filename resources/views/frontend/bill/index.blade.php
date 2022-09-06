@extends('frontend.layout.master')
@section('main-content')
<div class="mb-4">


<form class="d-flex">
    @csrf
      <div class="input-group input-group">
        <input type="text" class="form-control customerName" placeholder="Enter a custome's name">
        <span class="input-group-append">
            <input type="text" value="" name="todays-date" class="form-control text-center" id="todays-date">
        </span>
      </div>

</form>
</div>




    <div class="table">
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        {{-- <th>Order</th>
                        <th>Size</th>
                        <th>Quantity</th> --}}
                        <th>Total</th>
                        <th>Advance</th>
                        <th>Balance Amount</th>
                        <th>Ordered Date</th>
                        <th>Delivery Date</th>
                        <th>Prepared By</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody class="allData">
                   

                    @forelse($bills as $index=>$bill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="w-25">
                                @if (isset($bill->name))
                                    {{ $bill->name }}
                                @else
                                    <p>-----</p>
                                @endif
                            </td>

                     

                            {{-- <td>
                                @foreach ($bill->billOrders as $index => $billOrder)
                                    {{ $billOrder->orders->name }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($bill->billOrders as $index => $billOrder)
                                    {{ $billOrder->sizes->name }},
                                @endforeach
                            </td>

                            <td>
                                @foreach ($bill->billOrders as $index => $billOrder)
                                    {{ $billOrder->quantity }},
                                @endforeach
                            </td>  --}}
                            <td>
                               {{ $bill->grand_total }}
                            </td>
                            <td>
                                @if($bill->paid_amount===0)
                                <span class="badge badge-danger">Unpaid</span>
                                    @else
                                    {{ $bill->paid_amount }}
                                    @endif
                            </td>
                            <td>
                                @if($bill->balance_amount===0)
                                <span class="badge badge-success">Paid</span>
                                    @else
                                    {{ $bill->balance_amount }}
                                    @endif
                            </td>
                            <td>{{ $bill->ordered_date }}</td>
                            <td>{{ $bill->delivery_date }}</td>
                            <td>
                              {{ $bill->users->name }}
                            </td>
                            <td>
                                <a href="{{ route('bill.searches',$bill->qr_code) }}" class="btn btn-success"><i class="far fa-eye"></i></a>

                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="{{ route('bills.show',$bill->id) }}" class="btn btn-warning"><i class="fas fas fa-print"></i></a>

                            </td>
                        @empty
                            <td colspan="11" class="text text-danger">
                               No bills
                            </td>

                        </tr>
                    @endforelse

                    @if(isset($customerDetail))
                        {{ $customerDetail }}
                    @endif
                </tbody>

                <tbody id="content"></tbody>
            </table>

        </div>

    </div>
@endsection


@section('js')
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
type="text/javascript"></script>
<script src="http://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>

@include('frontend.bill.include.filter')
@include('frontend.bill.include.scripts.nepalidate')
@endsection

