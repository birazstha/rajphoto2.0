@extends('system.layouts.listing')

@section('header')
    <x-system.search-form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.form.form-inline-group :input="['name' => 'keyword', 'placeholder' => 'Keyword', 'default' => Request::get('keyword')]"></x-system.form.form-inline-group>
        </x-slot>
    </x-system.search-form>
@endsection

@section('create')
@endsection


@if (isset($order_id))
    @section('create')
        <div class="col-6">
            <a class="btn btn-primary pull-right btn-sm" id="addNew"
                href="{{ route('sizes.create') . '/?order_id=' . $order_id }}">
                <em class="fa fa-plus"></em> Add New
            </a>
        </div>
    @endsection
@endif

@section('table-heading')
    <tr>
        <th scope="col">S.No</th>
        <th scope="col">Customer's Name</th>
        <th scope="col">Prepared By</th>
        <th scope="col">QR Code</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
@endsection

@section('table-data')
    @php $pageIndex = pageIndex($items); @endphp
    @foreach ($items as $key => $item)
        <tr>

            <td>{{ SN($pageIndex, $key) }}</td>
            <td>{{ $item->customers->name }}</td>
            <td>
              {{ $item->users->name }}
            </td>
            <td>{{ $item->qr_code }}</td>


            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
            </td>
        </tr>
    @endforeach
@endsection




