@section('main-content')

    <div class="table">
        <div class="table-responsive">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Order</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Advance</th>
                    <th>Balance Amount</th>
                    <th>Action</th>

                </tr>
                </thead>

                <tbody>

                @forelse($data['rows'] as $index=>$bill)
                    <tr>
                <td>{{$index+1}}</td>
                        <td>
                            @if(isset($bill->name))
                                {{$bill->name}}
                            @else
                                <p>-----</p>
                            @endif
                        </td>

                <td>{{$bill->order->name}}</td>
                        <td>
                        @if(isset($bill->size->name))
                            {{$bill->size->name}}
                            @else
                            <p>-----</p>
                            @endif
                        </td>

                <td>{{$bill->quantity}}</td>
                        <td>
                            @if(isset($bill->total))
                                {{$bill->total}}
                            @else
                                <p>-----</p>
                            @endif
                        </td>
                <td>{{$bill->paid_amount}}</td>
                        <td>
                            @if(isset($bill->balance_amount))
                                {{$bill->balance_amount}}
                            @else
                                <p>-----</p>
                            @endif
                        </td>
                <td>
                    <a href="{{route($base_route.'show',$bill->id)}}" class="btn btn-success"><i class="far fa-eye"></i></a>

                    <a href="" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="{{route('frontend.bill.search',['id'=>$bill->qr_code])}}" class="btn btn-warning"><i class="fas fas fa-print"></i></a>

                </td>
                        @empty
                        <td>
                            <p>No bills</p>
                        </td>

                    </tr>
                @endforelse



                </tbody>
            </table>

        </div>

    </div>
@endsection

@section('js')
    @include($base_route.'include.script')
@endsection

@include('frontend.layout.master')


