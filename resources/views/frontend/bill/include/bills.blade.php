@php
    $dataCount = $bills->count();
    $count = 1;
@endphp




<table class="room-table">
    <thead>
        <tr>
            <th class="text-center">S.No</th>
            <th class="text-center">Customer's Detail</th>
            <th class="text-center">Order's Detail</th>
            <th class="text-center">Amount Details</th>
            <th class="text-center">Date</th>
            <th class="text-center">Prepared By</th>
            <th class="text-center">Action</th>

        </tr>
    </thead>

    <tbody>

        @forelse ($bills as $key => $bill)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                {{-- <td>{{ $bill->id }}</td> --}}
                <td class="center">

                    <div class="customer-detail">
                        <div class="test1">
                            <div>
                                <span class="font-weight-bold">Name:</span>
                                <span id="customer-name">
                                    <a id=""
                                        href="{{ route('customerResult', $bill->customers->id) }}">{{ $bill->customers->name }}
                                    </a>
                                </span>
                            </div>
                            <div>
                                <span class="font-weight-bold">Phone:</span> {{ $bill->customers->phone_number }}
                            </div>
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

                <td>
                    <div class="test3">
                        <div class="amounts">
                            <div>
                                <div class="font-weight-bold">Total:</div>
                                <div class="font-weight-bold">Advance:</div>
                                <div class="font-weight-bold">Due:</div>
                            </div>
                            <div>
                                <div>Rs. {{ $bill->grand_total }}</div>
                                <div>
                                    @if ($bill->paid_amount === 0)
                                        <span class="badge badge-danger badge-sm">Unpaid</span>
                                    @else
                                        Rs. {{ $bill->paid_amount }}
                                    @endif
                                </div>
                                <div>
                                    @if ($bill->due_amount === 0)
                                        <span class="badge badge-success ">Paid</span>
                                    @else
                                        Rs. {{ $bill->due_amount }}
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </td>

                <td class="text-center">

                    <div class="customer-detail">
                        <div class="test1">
                            <div>
                                <b>Ordered Date:</b> {{ $bill->ordered_date }}
                            </div>
                            <div>
                                <b>Delivery Date:</b> {{ $bill->delivery_date }}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center">{{ $bill->users->name }}</td>

                <td class="text-center">

                    <button data-toggle="modal" data-target="#billDetail{{ $bill->id }}" target="_blank"
                        data-bill={{ $bill->due_amount }} class="btn btn-success btn-sm open-AddBookDialog"><i
                            class="far fa-eye"></i></button>
                    @include('frontend.bill.include.clearBill')


                    <a href="{{ route('bills.show', $bill->id) }}" target="_blank" class="btn btn-info btn-sm"><i
                            class="fas fa-info-circle"></i></a>
                </td>
            </tr>
        @empty
            <td colspan="9" class="text text-danger text-center">No data found</td>
        @endforelse

    </tbody>

</table>

{{-- Show pagination when exceeds 10 --}}
<div class="d-flex justify-content-between">


    @if ($bills->count() != 0)
        <div class="">
            Showing 1 to {{ $bills->count() }} entries of {{ $bills->count() }} entries.
        </div>
        {{-- @if ($dataCount >= 1)
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="">Previous</a></li>
                <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=1">1</a></li>
                <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=2">2</a></li>
                <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=3">3</a></li>
                <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=4">Next</a>
                </li>
            </ul>
        @endif --}}
    @endif
</div>
