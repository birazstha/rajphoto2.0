@php
// $dataCount = $bills->count();
$count = 1;
@endphp
<div class="table">
    <div class="table-responsive">
        <table class="table table-bordered table-bills">
            <thead>
                <th>S.No</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Order Detail</th>
                <th>Total</th>
                <th>Advance</th>
                <th>Due Amount</th>
                <th>Ordered Date</th>
                <th>Delivery Date</th>
                <th>Prepared By</th>
                <th>Action</th>
            </thead>
            <tbody>

                @forelse ($customers as $key => $customer)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td class="change">
                            @foreach ($customer->bills as $bill)
                                @foreach ($bill->billOrders as $key => $billOrder)
                                    <div class="order-detail">
                                        {{ $key + 1 }}. {{ $billOrder->orders->name }} -
                                        {{ $billOrder->sizes->name }} - {{ $billOrder->quantity }} pc
                                    </div>
                                @endforeach
                            @endforeach

                        </td>
                        <td>

                            @foreach ($customer->bills as $bill)
                                Rs.{{ $bill->grand_total }}
                            @endforeach

                        </td>
                        <td>
                            @foreach ($customer->bills as $bill)
                                @if ($bill->paid_amount === 0)
                                    <span class="badge badge-danger">Unpaid</span>
                                @else
                                    Rs.{{ $bill->paid_amount }}
                                @endif
                            @endforeach

                        </td>
                        <td>
                            @foreach ($customer->bills as $bill)
                                @if ($bill->due_amount === 0)
                                    <span class="badge badge-success">Paid</span>
                                @else
                                    Rs.{{ $bill->due_amount }}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($customer->bills as $bill)
                                {{ $bill->ordered_date }}
                            @endforeach

                        </td>
                        <td>

                            @foreach ($customer->bills as $bill)
                                {{ $bill->delivery_date }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($customer->bills as $bill)
                                {{ $bill->users->name }}
                            @endforeach
                        </td>
                        <td>

                            @foreach ($customer->bills as $bill)
                                <a href="{{ route('bill.searches', $bill->qr_code) }}" target="_blank"
                                    class="btn btn-success"><i class="far fa-eye"></i></a>
                                <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{ route('bills.show', $bill->id) }}" target="_blank"
                                    class="btn btn-warning"><i class="fas fas fa-print"></i></a>
                            @endforeach

                        </td>
                    </tr>
                @empty
                    <td colspan="9" class="text text-danger">No data found</td>
                @endforelse
            </tbody>
        </table>


        {{-- Show pagination when exceeds 10 --}}
        <div class="d-flex justify-content-between">


            {{-- @if ($bills->count() != 0)
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
            @endif --}}
        </div>
    </div>
</div>
