@php
    $dataCount = $bills->count();
    $count = 1;
@endphp




    <table class="room-table">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Customer's Detail</th>
                <th>Order's Detail</th>
                <th>Amount Details</th>
                <th>Delivery Date</th>
                <th>Prepared By</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
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

                    <td>
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
                    </td>
                    <td class="text-center">{{ $bill->delivery_date }}</td>
                    <td class="text-center">{{ $bill->users->name }}</td>
                    <td class="text-center">
                        @if ($bill->status)
                            <span class="badge badge-success">Delivered</span>
                        @else
                            <span class="badge badge-info">Pending</span>
                        @endif
                    </td>
                    <td class="text-center">

                        <button data-toggle="modal" data-target="#billDetail{{ $bill->id }}" target="_blank"
                            data-bill={{ $bill->due_amount }} class="btn btn-success open-AddBookDialog"><i
                                class="far fa-eye"></i></button>
                        @include('frontend.bill.include.modal')

                        {{-- <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> --}}
                        <a href="{{ route('bills.show', $bill->id) }}" target="_blank" class="btn btn-info"><i
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
            @if ($dataCount >= 1)
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=3">3</a></li>
                    <li class="page-item"><a class="page-link" href="http://localhost/rajphoto2.0/bills?page=4">Next</a></li>
                </ul>
            @endif
        @endif 
    </div>


