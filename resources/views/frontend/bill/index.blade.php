@extends('frontend.layout.master')
@section('main-content')


<div class="mb-4">
<form class="d-flex">
    @csrf
      <div class="input-group input-group-sm">
        <input type="text" class="form-control customerName" placeholder="Enter a custome's name">
        <span class="input-group-append">
          <button type="button" class="btn btn-info btn-flat">Search</button>
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
                        <th>Ordered Date</th>
                        <th>Delivery Date</th>
                        {{-- <th>Order</th>
                        <th>Size</th>
                        <th>Quantity</th> --}}
                        <th>Total</th>
                        <th>Advance</th>
                        <th>Balance Amount</th>
                        <th>Prepared By</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody class="allData">
                   

                    @forelse($bills as $index=>$bill)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if (isset($bill->name))
                                    {{ $bill->name }}
                                @else
                                    <p>-----</p>
                                @endif
                            </td>

                            <td>{{ $bill->ordered_date }}</td>
                            <td>{{ $bill->delivery_date }}</td>

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
                            </td> --}}
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
                            <td>
                              {{ $bill->users->name }}
                            </td>
                            <td>
                                <a href="{{ route('bill.searches',$bill->qr_code) }}" class="btn btn-success"><i class="far fa-eye"></i></a>

                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="{{ route('bills.show',$bill->id) }}" class="btn btn-warning"><i class="fas fas fa-print"></i></a>

                            </td>
                        @empty
                            <td>
                                <p>No bills</p>
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
@include('frontend.bill.include.filter')
@endsection

