

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

                @forelse ($bills as $key => $c)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->grand_total }}</td>
                        <td>{{ $c->paid_amount }}</td>  
                        <td>{{ $c->balance_amount }}</td>
                        <td>{{ $c->ordered_date }}</td>
                        <td>{{ $c->delivery_date }}</td>
                        <td>{{ $c->users->name }}</td>
                        <td>
                            <a href="{{ route('bill.searches',$c->qr_code) }}" target="_blank" class="btn btn-success"><i
                                    class="far fa-eye"></i></a>
                            <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            <a href="{{ route('bills.show',$c->id) }}" target="_blank" class="btn btn-warning"><i
                                    class="fas fas fa-print"></i></a>
                        </td>
                    </tr>
                    @empty
                    <td colspan="9" class="text text-danger">No dat found</td>
                @endforelse


            {{ $bills }}

            </tbody>

        </table>


    </div>




</div>
