@extends('system.layouts.master')
@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            @include('system.partials.message')

            <div>Today's Income:</div>
            <h1> Rs. {{ $income }}</h1>


        </div>
        

    @section('table-heading')
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">Customer's Name</th>
            <th scope="col" style="width: 5px">QR Code</th>

            <th scope="col">Prepared By</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    @endsection


    @section('table-data')
        @php $pageIndex = pageIndex($bills); @endphp
        @foreach ($bills as $key => $item)
            <tr>

                <td>{{ SN($pageIndex, $key) }}</td>
                <td>{{ $item->customers->name }}</td>
                <td>
                    {!! QrCode::size(100)->generate($item->qr_code) !!}
                </td>
                <td>
                    {{ $item->users->name }}
                </td>


                <td>
                    @include('system.partials.editButton')
                    @include('system.partials.deleteButton')
                </td>
            </tr>
        @endforeach
    @endsection


</div>
@endsection
