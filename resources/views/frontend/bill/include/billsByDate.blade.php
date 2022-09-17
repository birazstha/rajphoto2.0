@php
$dataCount = $bills->count();
$count = 1;
@endphp

<div class="d-flex justify-content-between mb-2 align-items-center">
    <h2>Bills</h2>
    <a href="{{ route('bills.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbspCreate</a>
</div>
<div class="table">

    <div class="table-responsive">
        <table class="table table-bordered table-bills">
            <thead>
                <th>S.No</th>
                <th>Customer's Detail</th>
                <th>Order's Detail</th>
                <th>Total</th>
                <th>Advance</th>
                <th>Due Amount</th>
                <th>Ordered Date</th>
                <th>Delivery Date</th>
                <th>Prepared By</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>

                @forelse ($bills as $key => $bill)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        {{-- <td>{{ $bill->id }}</td> --}}
                        <td class="center">
                            <div class="customer-detail">
                                <div>
                                    <span class="font-weight-bold">Name:</span> {{ $bill->customers->name }}
                                </div>
                                <div>
                                    <span class="font-weight-bold">Phone:</span> {{ $bill->customers->phone_number }}
                                </div>
                            </div>
                        </td>
                        <td class="change">
                            @foreach ($bill->billOrders as $key => $billOrder)
                                <div class="order-detail">
                                    {{ $key + 1 }}. {{ $billOrder->orders->name }} - {{ $billOrder->sizes->name }}
                                    - {{ $billOrder->quantity }} pc
                                </div>
                            @endforeach

                        </td>
                        <td> Rs.{{ $bill->grand_total }}</td>
                        <td>
                            @if ($bill->paid_amount === 0)
                                <span class="badge badge-danger">Unpaid</span>
                            @else
                                Rs.{{ $bill->paid_amount }}
                            @endif
                        </td>
                        <td>
                            @if ($bill->due_amount === 0)
                                <span class="badge badge-success">Paid</span>
                            @else
                                Rs.{{ $bill->due_amount }}
                            @endif
                        </td>
                        <td>{{ $bill->ordered_date }}</td>
                        <td>{{ $bill->delivery_date }}</td>
                        <td>{{ $bill->users->name }}</td>
                        <td>
                            @if ($bill->status)
                                <span class="badge badge-success">Delivered</span>
                            @else
                                <span class="badge badge-info">Pending</span>
                            @endif
                        </td>
                        <td>

                            <button data-toggle="modal" data-target="#billDetail{{ $bill->id }}" target="_blank"
                                data-bill={{ $bill->due_amount }} class="btn btn-success open-AddBookDialog"><i
                                    class="far fa-eye"></i></button>
                            @include('frontend.bill.include.modal')

                            {{-- <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> --}}
                            <a href="{{ route('bills.show', $bill->id) }}" target="_blank" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                        </td>
                    </tr>
                @empty
                    <td colspan="9" class="text text-danger">No data found</td>
                @endforelse
            </tbody>
        </table>


        {{-- Show pagination when exceeds 10 --}}
        <div class="d-flex justify-content-between">


            @if ($bills->count() != 0)
                <div class="">
                    Showing 1 to {{ $bills->count() }} entries of {{ $bills->count() }} entries.
                </div>
                @if ($dataCount >= 10)
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000?page=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000?page=2">2</a></li>
                        <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000?page=3">3</a></li>
                        <li class="page-item"><a class="page-link" href="http://127.0.0.1:8000?page=4">Next</a></li>
                    </ul>
                @endif
            @endif
        </div>
    </div>
</div>
