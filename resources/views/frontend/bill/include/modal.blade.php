<div class="modal fade" id="billDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              
                <form action="{{ route('bills.update', 1) }}" method="POST">
                    @csrf
                    {{-- Due Amount --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Due Amount</label>
                        <div class="col-sm-8">
                            <input type="number" id="due_amount" readonly value="" class="form-control"
                                id="inputPassword">
                        </div>
                    </div>

                    {{-- Discount --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Discount</label>
                        <div class="col-sm-8">
                            <input type="number" value="0" class="form-control" id="discount">
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <input type="number" value="" class="form-control" id="total">
                        </div>
                    </div>


                    {{-- Cash Received --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cash Received</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cash_received">
                        </div>
                    </div>

                    {{-- Cash Return --}}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cash Return</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="cash_return">
                        </div>
                    </div>

                      {{-- Cleared By --}}
                      <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Cleared By</label>
                        <div class="col-sm-8">
                            <select name="" id="" class="form-control">
                                <option value="">Select your name</option>
                                @foreach ($users as $user )
                                <option value="{{ $user->id }}">{{ $user->name }}a</option> 
                                @endforeach
                               
                            </select>
                        </div>
                    </div>

    
                    <div class="modal-footer">
                        <button type="sumbit" class="btn btn-primary">Clear Bill</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>


            </div>

        </div>
    </div>
</div>
