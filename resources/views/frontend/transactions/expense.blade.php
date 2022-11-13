<div class="modal fade" id="expenseTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Transaction - Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('expense.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <!--Prepared by-->
                    <div class="form-group row">
                        {!! Form::label('expense_id', 'Expense', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                
                            <select name="expense_id" id="expense" class="form-control" required>
                                <option value="" selected>Select Expense Title</option>
                                @foreach ($expenses as $expense)
                                    <option value="{{ $expense->id }}">{{ $expense->title }}</option>
                                @endforeach
                            </select>
                
                            @error('expense_id')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                       <!--Description-->
                       <div class="form-group row d-none" id="toggle-description-expense">
                        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">

                            <textarea name="description" id="" cols="10" rows="3" class="form-control" name="description"></textarea>

                            @error('description')
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
                    
                
                
                  
                    <input type="hidden" name="date" class="current_date" value="">
                
                    <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
                </form>
            </div>

        </div>
    </div>
</div>
