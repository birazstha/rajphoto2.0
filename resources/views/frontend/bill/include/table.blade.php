@php
$dataCount = $bills->count();
$count = 1;
@endphp
<div class="table">
    <div class="table-responsive">
        <table class="table table-bordered table-bills">
            <thead>
                <th>S.No</th>
                <th>Name</th>
                <th>Total</th>
                <th>Advance</th>
                <th>Balance Amount</th>
                <th>Ordered Date</th>
                <th>Delivery Date</th>
                <th>Prepared By</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse ($bills as $key => $bill)
                    <tr>
                        <td>{{ $bill->id }}</td>
                        <td>{{ $bill->name }}</td>
                        <td>{{ $bill->grand_total }}</td>
                        <td>{{ $bill->paid_amount }}</td>
                        <td>{{ $bill->balance_amount }}</td>
                        <td>{{ $bill->ordered_date }}</td>
                        <td>{{ $bill->delivery_date }}</td>
                        <td>{{ $bill->users->name }}</td>
                        <td>
                            <a href="{{ route('bill.searches', $bill->qr_code) }}" target="_blank" class="btn btn-success"><i
                                    class="far fa-eye"></i></a>
                            <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            <a href="{{ route('bills.show', $bill->id) }}" target="_blank" class="btn btn-warning"><i
                                    class="fas fas fa-print"></i></a>
                        </td>
                    </tr>
                @empty
                    <td colspan="9" class="text text-danger">No dat found</td>
                @endforelse
            </tbody>
        </table>


        {{-- Show pagination when exceeds 10 --}}

        @include('frontend.bill.include.pagination')

       
   
    </div>
</div>
