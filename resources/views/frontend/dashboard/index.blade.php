@extends('frontend.layout.master')
@section('main-content')
    <div class="d-flex justify-content-between mt-2 mb-2">
        <div>
            <input type="text" name="todays-date" class="form-control" id="todays-date">
        </div>
        <div>
            <button class="btn btn-secondary" id="adjustmentt" data-toggle="modal" data-target="#adjustments"> <i
                    class="fa fa-plus"></i>
                Adjustment</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#withdraw"> <i class="fa fa-plus"></i>
                Withdraw</button>
        </div>

    </div>

    <div id="dashboard"></div>


    @include('frontend.dashboard.adjustment')
    @include('frontend.dashboard.withdraw')
@endsection

@section('js')
    <script src="{{ asset('public/compiledCssAndJs/js/frontend/dashboard.js') }}"></script>


    <script>
        $(document).ready(function() {
            $(document).on("keyup", "#closing_balancee", function() {
                var cashInDrawer = $(this).val();
                var closingBalance = $('#closing').val();
                var adjustment = cashInDrawer - closingBalance;
                $('#adjustment').val(adjustment);
            });

            //Focus on Cash on Drawer
            $('#adjustments').on('shown.bs.modal', function() {
                $('#closing_balancee').focus();
            })

            //Focus on Withdrawn amount
            $('#withdraw').on('shown.bs.modal', function() {
                $('#withdrawn_amount').focus();
            })

            $(function() {
                $('.html-tooltip').tooltip();
            });


        });

        $(document).on('change', '#adjustment_type', function() {
            var title = $("#adjustment_type option:selected").val();
            if (title === 'opening') {
                $('.toggle-amount').addClass('d-none');
                $('.toggle-adjustment').addClass('d-none');
                $('#closing_balancee').focus();

            } else {
                $('.toggle-amount').removeClass('d-none');
                $('.toggle-adjustment').removeClass('d-none');
                $('#closing_balancee').focus();
            }
        })
    </script>




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
