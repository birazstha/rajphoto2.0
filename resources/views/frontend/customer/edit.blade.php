<div class="modal fade" id="edit-customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('customers.update',$customers->id) }}" method="post" autocomplete="off">
                    @csrf

                    <input name="_method" type="hidden" value="PUT">
                    <!--Name-->
                    <div class="form-group row">
                        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                    
                                <input type="text" name="name" class="form-control" value="{{ $customers->name }}">
                
                            @error('name')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                
                        <!--Contact Number-->
                        <div class="form-group row">
                            {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-sm-2 col-form-label']) !!}
                            <div class="col-sm-10">
                                <input type="number" name="phone_number" value="{{ $customers->phone_number }}" id="phone_number"
                                class="form-control">
                                @error('phone_number')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                
                    <input type="hidden" name="date" class="current_date" value="">
                
                    <button class="btn btn-success btn-sm"><i class="fas fa-recycle"></i>&nbspUpdate</button>
                    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
                </form>
            </div>

        </div>
    </div>
</div>
