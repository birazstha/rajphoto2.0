@extends('system.layouts.form')
@section('inputs')

{{-- Name --}}
    <x-system.form.form-group :input="[
        'name' => 'bank_name',
        'required' => 'true',
        'label' => 'Name',
        'default' => $item->bank_name ?? old('bank_name'),
        'error' => $errors->first('bank_name'),
    ]" />


{{-- Status --}}
    <x-system.form.form-group :input="['label' => 'Status']">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
        </x-slot>
    </x-system.form.form-group>
@endsection
