@extends('system.layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('system.partials.message')
            <input type="text" name="todays-date" class="form-control" id="todays-date">
           
            <input type="text" name="yesterday-date" class="form-control" id="">
     

            <div id="income"></div>

            {{-- <div class="loader">
                <img src="{{ asset('public/images/loader.gif') }}" alt="">
            </div> --}}
        </div>
    </div>

    {{-- Modal --}}
    


 
   
    <div class="modal fade" id="adjustments" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="post">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Adjustment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            {{-- Closing Balance --}}
                            <div class="form-group">
                                <label class="form-label" for="">Closing Balance</label>
                                <input type="text" class="form-control" value="">
                            </div>
    
                            {{-- Cash In drawer --}}
                            <div class="form-group">
                                <label class="form-label" for="">Cash In Drawer</label>
                                <input type="text" class="form-control" value="">
                            </div>
    
                              {{-- Tomorrrow date --}}
                              <div class="form-group">
                                <label class="form-label" for="">Cash In Drawer</label>
                                <input type="text" class="form-control" value="" id="tomorrow_date">
                            </div>
    
    
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <em class="glyph-icon icon-close"></em> {{ translate('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-sm btn-success" id="confirmDelete">
                            <i class="fa fa-save"></i> {{ translate('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    

@endsection

@section('scripts')
<script src="{{ asset('public/compiledCssAndJs/js/dashboard.js') }}"></script>
@endsection
