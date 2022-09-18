<form action="{{ route('bills.store') }}" method="POST" autocomplete="off">
    @csrf
    <!--Prepared by-->
    <div class="form-group row">
        {!! Form::label('order_id', 'Income', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">

            <select name="order_id" class="form-control" required>
                <option value="" selected>Select Income Title</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->name }}</option>
                @endforeach
            </select>

            @error('order_id')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>




 

    <!--Rate-->
    <div class="row">
        <div class="col-4">
            <div class="form-group row">
                {!! Form::label('grand_total', 'Rate', ['class' => 'col-sm-6 col-form-label']) !!}
                <div class="col-sm-6">
                    <td><input type="number" name="grand_total" value=""
                            id="grand_total" class="form-control">
                    </td>
                </div>
            </div>
        </div>

        <!--Quantity-->
        <div class="col-4">
            <div class="form-group row">
                {!! Form::label('paid_amount', 'Quantity', ['class' => 'col-sm-3 col-form-label']) !!}
                <div class="col-sm-6">
                    <td><input type="number" name="paid_amount" value="{{ $item->paid_amount ?? '' }}"
                            id="paid_amount" class="form-control" {{ isset($item) ? 'readonly' : '' }} required>
                    </td>
                </div>
            </div>
            @error('paid_amount')
                <p class="text text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-4">
            <!--Total-->
            <div class="form-group row">
                {!! Form::label('total', 'Total', ['class' => 'col-sm-4 col-form-label']) !!}
                <div class="col-sm-6">
                    <td><input type="text" name="due_amount" id="due_amount" value="{{ $item->due_amount ?? '' }}"
                            readonly class="form-control"></td>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <!--Cash Received-->
            <div class="form-group row">
                <label for="order_date" class="col-sm-4 col-form-label">Cash Received</label>
                <div class="col-sm-8">
                    <input type="number" name="cash_received" value="{{ $item->cash_received ?? '' }}"
                        id="cash_received" class="form-control" required>
                </div>
            </div>

        </div>
        <div class="col-6">
            <!--Cash Return-->
            <div class="form-group row">
                <label for="texr" class="col-sm-4 col-form-label">Cash Return</label>
                <div class="col-sm-8">
                    <input type="text" name="cash_return" value="{{ $item->cash_return ?? '' }}"
                        id="cash_return" class="form-control" readonly>
                </div>
            </div>
            @error('delivery_date')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <button class="btn btn-success btn-sm">Save</button>
</form>
