@extends('frontend.layout.master')
@section('main-content')
<form action="{{ route('saving.store') }}" method="POST" autocomplete="off" id="form">
    @csrf
    <!--Prepared by-->
    <div class="form-group row">
        {!! Form::label('saving_id', 'Bank', ['class' => 'col-sm-2 col-form-label']) !!}
        <div class="col-sm-10">

            <select name="saving_id" id="other" class="form-control" required>
                <option value="" selected>Select Bank</option>
                @foreach ($savings as $saving)
                    <option value="{{ $saving->id }}">{{ $saving->bank_name }}</option>
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
    


    {{-- <div class="row">
        <div class="col-6">
            <!--Cash Received-->
            <div class="form-group row">
                <label for="order_date" class="col-sm-4 col-form-label">Cash Received</label>
                <div class="col-sm-8">
                    <input type="number" name="cash_received" value="{{ $item->cash_received ?? '' }}"
                        id="other_cash_received" class="form-control" required>
                </div>
            </div>

        </div>
        <div class="col-6">
            <!--Cash Return-->
            <div class="form-group row">
                <label for="texr" class="col-sm-4 col-form-label">Cash Return</label>
                <div class="col-sm-8">
                    <input type="text" name="cash_return" value="{{ $item->cash_return ?? '' }}"
                        id="other_cash_return" class="form-control" readonly>
                </div>
            </div>
            @error('delivery_date')
                <span class="text text-danger">{{ $message }}</span>
            @enderror
        </div>

     
    </div> --}}

    <input type="hidden" name="date" class="order-date" value="">

    <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
    <button type="reset" class="btn btn-secondary btn-sm"><i class="fas fa-recycle"></i> Reset</button>
</form>
@endsection

@section('js')
    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
        type="text/javascript"></script>
    <script>
        $("document").ready(function() {
            $(".tab-slider--body").hide();
            $(".tab-slider--body:first").show();
        });

        $(".tab-slider--nav li").click(function() {
            $(".tab-slider--body").hide();
            var activeTab = $(this).attr("rel");
            $("#" + activeTab).fadeIn();
            if ($(this).attr("rel") == "tab2") {
                $('.tab-slider--tabs').addClass('slide');
            } else {
                $('.tab-slider--tabs').removeClass('slide');
            }
            $(".tab-slider--nav li").removeClass("active");
            $(this).addClass("active");
        });


        var currentBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), 'YYYY-MM-DD');
        $('.order-date').val(currentBsDate);






        //For Other Incomes

        const calculatetotal = function(data) {
            var quantity = $("#other_quantity").val();
            var total = quantity * data;
            $("#other_total").val(total)

        };

        $("#other").change(function() {
            var incomeTitle = $(this).val();
            $.ajax({
                method: 'get',
                url: "{{ URL::route('bill.getRate') }}",
                data: {
                    'order_id': incomeTitle,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'text',
                success: function(response) {
                    $("#other_rate").val(response);
                    calculatetotal(response);
                },
            });
        });

        $("#other_rate").on('keyup change', function() {
            var rate = $(this).val()
            calculatetotal(rate);
        });

        $("#other_quantity").on('keyup change', function() {
            var quantity = $(this).val()
            var currRate = $("#other_rate").val();
            var totaldd = quantity * currRate;
            $("#other_total").val(totaldd);

        });

        $("#other_cash_received").on('keyup', function() {
            var cashReceived = $(this).val();
            var total = $("#other_total").val();
            var cashReturn = cashReceived - total;
            $("#other_cash_return").val(cashReturn);
        });
    </script>
@endsection
