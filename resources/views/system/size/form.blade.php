@extends('system.layouts.form')
@section('inputs')
    {{-- Title --}}
    <x-system.form.form-group :input="[
        'name' => 'title',
        'required' => 'true',
        'label' => 'Title',
        'default' => $item->title ?? old('title'),
        'error' => $errors->first('title'),
    ]" />

    <x-system.form.form-group :input="['name' => 'order_id', 'label' => 'Order', 'required' => true]">
        <x-slot name="inputs">
            <x-system.form.input-select :input="[
                'name' => 'order_id',
                'label' => 'Role',
                'required' => true,
                'default' => $item->order_id ?? old('order_id'),
                'options' => $orders,
                'placeholder' => 'Select role',
                'error' => $errors->first('order_id'),
            ]" />
        </x-slot>
    </x-system.form.form-group>

    {{-- Status --}}
    <x-system.form.form-group :input="['label' => 'Status']">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
        </x-slot>
    </x-system.form.form-group>
@endsection
