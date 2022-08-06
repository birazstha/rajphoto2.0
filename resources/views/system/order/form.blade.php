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

    {{-- Rank --}}
    <x-system.form.form-group :input="[
        'name' => 'rank',
        'type'=>'number',
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

    <x-system.form.form-group :input="['name' => 'details_required', 'label' => 'Detail Required ?', 'required' => true]">
        <x-slot name="inputs">
            <x-system.form.input-radio :input="[
                'name' => 'details_required',
                'required' => true,
                'default' => old('details_required') ?? 0,
                'options' => [
                    ['value' => '0', 'label' => 'Yes'], //Send Activation Link
                    ['value' => '1', 'label' => 'No'], //Set Password
                ],
            ]" />
        </x-slot>
    </x-system.form.form-group>
@endsection
