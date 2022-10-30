<div class="modal fade" id="savings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Transaction - Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('saving.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <!--Prepared by-->
                    <div class="form-group row">
                        {!! Form::label('saving_id', 'Bank Name', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                    
                
                            <select name="saving_id" id="other" class="form-control" required>
                                <option value="" selected>Select Expense Title</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                
                            @error('saving_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                        <!--Amount-->
                        <div class="form-group row">
                            {!! Form::label('amount', 'Amount', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                <input type="number" name="amount" value="" id="amount"
                                class="form-control">
                                @error('amount')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                
                
                  
                    <input type="hidden" name="date" class="order-date" value="">
                
                    <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
                </form>
            </div>

        </div>
    </div>
</div>
