<div class="modal fade" id="billDetail{{ $bill->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bill of {{ $bill->customers->name }}
                    ({{ $bill->customers->phone_number }}) </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`
            <div class="modal-body">
                <form method="post" action="{{ route('bills.update', $bill->id) }}">
                    @csrf
                    @method('put')
                    {{-- Due Amount --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Due Amount</label>
                        <div class="col-sm-8">
                            <input type="text" name="due_amount" id="due_amount" readonly class="form-control"
                                id="inputPassword" value="{{ $bill->due_amount == 0 ? 'Paid' : $bill->due_amount }}">
                        </div>
                    </div>

                    {{-- Discount --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Discount</label>
                        <div class="col-sm-8">
                            <input type="number" name="discount" value="0" class="form-control" id="discount"
                                {{ $bill->due_amount == 0 ? 'readonly' : '' }}>
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <input type="text" name="total" value="" class="form-control total"
                                id="total" {{ $bill->due_amount == 0 ? 'readonly' : '' }}>
                        </div>
                    </div>


                    {{-- Cash Received --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cash Received</label>
                        <div class="col-sm-8">
                            <input type="number" name="cash_received" class="form-control" id="cash_received"
                                {{ $bill->due_amount == 0 ? 'readonly' : '' }}>
                        </div>
                    </div>

                    {{-- Cash Return --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cash Return</label>
                        <div class="col-sm-8">
                            <input type="number" name="cash_return" class="form-control cash_return" id="cash_return"
                                readonly>
                        </div>
                    </div>

                    {{-- Cleared By --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cleared By</label>
                        <div class="col-sm-8">
                            <select name="user_id" id="" class="form-control">
                                <option value="">Select your name</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <input type="text" hidden name="cleared_date" class="cleared_date" value=""
                        id="cleared_date">

                    <input type="hidden" name="bill_id" value="{{ $bill->id }}">


                    <div class="modal-footer">
                        <button type="sumbit" class="btn btn-primary">Clear Bill</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
