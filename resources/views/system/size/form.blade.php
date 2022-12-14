@extends('system.layouts.form')
@section('inputs')
    {{-- Name --}}
    <x-system.form.form-group :input="[
        'name' => 'name',
        'required' => 'true',
        'label' => 'Name',
        'default' => $item->name ?? old('name'),
        'error' => $errors->first('name'),
    ]" />

@if(isset($order_id))
<x-system.form.form-group :input="['name' => 'order_id', 'label' => 'Order', 'required' => true]">
    <x-slot name="inputs">
        <x-system.form.input-select :input="[
            'name' => 'order_id',
            'label' => 'Order',
            'required' => true,
            'default' => $order_id,
            'options' => $orders,
            'placeholder' => 'Select Order',
            'error' => $errors->first('order_id'),
        ]" />
    </x-slot>
</x-system.form.form-group>
@else
<x-system.form.form-group :input="['name' => 'order_id', 'label' => 'Order', 'required' => true]">
    <x-slot name="inputs">
        <x-system.form.input-select :input="[
            'name' => 'order_id',
            'label' => 'Order',
            'required' => true,
            'default' => $item->order_id ?? old('order_id'),
            'options' => $orders,
            'placeholder' => 'Select Order',
            'error' => $errors->first('order_id'),
        ]" />
    </x-slot>
</x-system.form.form-group>
@endif

 {{-- Rate --}}
 <x-system.form.form-group :input="[
    'name' => 'rate',
    'required' => 'true',
    'label' => 'Rate',
    'default' => $item->rate ?? old('rate'),
    'error' => $errors->first('rate'),
]" />


    {{-- Status --}}
    <x-system.form.form-group :input="['label' => 'Status']">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
        </x-slot>
    </x-system.form.form-group>
@endsection