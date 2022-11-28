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

    {{-- Rank --}}
    <x-system.form.form-group :input="[
        'type'=>'number',
        'name' => 'rank',
        'required' => 'true',
        'label' => 'Rank',
        'default' => $item->rank ?? old('rank'),
        'error' => $errors->first('rank'),
    ]" />


{{-- Status --}}
    <x-system.form.form-group :input="['label' => 'Status']">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
        </x-slot>
    </x-system.form.form-group>
@endsection
