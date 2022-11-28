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
        'type' => 'number',
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
                'default' => $item->details_required ?? '1',
                'options' => [
                    ['value' => '1', 'label' => 'Yes'], //Send Activation Link
                    ['value' => '0', 'label' => 'No'], //Set Password
                ],
            ]" />
        </x-slot>
    </x-system.form.form-group>

    {{-- Rank --}}
    <div class="order-rate d-none">
        <x-system.form.form-group :input="[
            'name' => 'rate',
            'type' => 'number',
            'label' => 'Rate',
            'default' => $item->rate ?? old('rate'),
            'error' => $errors->first('rate'),
        ]" />
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('input[type=radio][name=details_required]').on('change', function() {
                var data = $(this).val();
                if (data == 0) {
                    $('.order-rate').toggleClass('d-none');
                } else {
                    $('.order-rate').toggleClass('d-none');

                }
            });
        })
    </script>
@endsection
