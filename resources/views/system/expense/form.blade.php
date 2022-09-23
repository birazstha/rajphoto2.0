@extends('system.layouts.form')
@section('inputs')

{{-- Name --}}
    <x-system.form.form-group :input="[
        'name' => 'title',
        'required' => 'true',
        'label' => 'Name',
        'default' => $item->title ?? old('title'),
        'error' => $errors->first('title'),
    ]" />


{{-- Status --}}
    <x-system.form.form-group :input="['label' => 'Status']">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
        </x-slot>
    </x-system.form.form-group>
@endsection
