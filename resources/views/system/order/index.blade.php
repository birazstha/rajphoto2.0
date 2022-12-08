@extends('system.layouts.listing')
@section('header')
    <x-system.search-form :action="$indexUrl">
        <x-slot name="inputs">
            <x-system.form.form-inline-group :input="['name' => 'keyword', 'placeholder' => 'Keyword', 'default' => Request::get('keyword')]"></x-system.form.form-inline-group>
        </x-slot>
    </x-system.search-form>
@endsection

@section('table-heading')
    <tr>
        <th scope="col">S.No</th>
        <th scope="col">Name</th>
        <th scope="col">Rank</th>
        <th scope="col">Status</th>
        <th scope="col">Detail Required?</th>
        <th scope="col">Action</th>
    </tr>
@endsection

@section('table-data')
    @php $pageIndex = pageIndex($items); @endphp
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ SN($pageIndex, $key) }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->rank }}</td>
            <td>
                <a href="{{ url('system/order/' . $item->id . '/status') }}">
                    @if ($item->status == 1)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">
                            Inactive
                        </span>
                    @endif
                </a>
            </td>
            <td>
                @if ($item->details_required == 1)
                    <span class="badge badge-success">Yes</span>
                @else
                    <span class="badge badge-danger">No</span>
                @endif
            </td>

            <td>
                @include('system.partials.editButton')
                @include('system.partials.deleteButton')
                <a href="{{ route('sizes.create') . '/?order_id=' . $item->id }}">
                    <button class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Size</button>
                </a>
                <a href="{{ route('sizes.index') . '/?order_id=' . $item->id }}">
                    <button class="btn btn-info btn-sm"><i class="fas fa-list"></i> Sizes</button>
                </a>
            </td>
        </tr>
    @endforeach
@endsection
