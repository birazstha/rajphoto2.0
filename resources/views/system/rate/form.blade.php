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

<x-system.form.form-group :input="['name' => 'size_id', 'label' => 'Size', 'required' => true]">
    <x-slot name="inputs">
        <x-system.form.input-select :input="[
            'name' => 'size_id',
            'label' => 'Order',
            'required' => true,
            'default' => $item->size_id ?? old('size_id'),
            'options' => $sizes,
            'placeholder' => 'Select a size',
            'error' => $errors->first('size_id'),
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

@section('scripts')
<script>
   $('#order_id').change(function(){
            var order = $(this).val();
            var path = "{{ URL::route('order.getSize') }}";
            $.ajax({
                url: path,
                data: {
                    'order_id': order,
                    '_token': "{{ csrf_token() }}"
                },
                method: 'post',
                dataType: 'text',
                success: function(response) {
                    $('#size_id').empty();
                    $('#size_id').append(response);

                }
            });
        });
</script>
@endsection