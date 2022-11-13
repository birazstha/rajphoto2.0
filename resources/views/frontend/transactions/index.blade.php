@extends('frontend.layout.master')
@section('main-content')
    {{ Session::has('success') }}


    <div class="bill-index">

        <div class="d-flex justify-content-between mb-2 align-items-center">
            <h2>Transactions</h2>
            <div>
                <button data-toggle="modal" data-target="#incomeTransaction" target="_blank"
                    class="btn btn-success open-AddBookDialog"><i class="fa fa-plus"></i>&nbspIncome</button>
                <button data-toggle="modal" data-target="#expenseTransaction" target="_blank"
                    class="btn btn-danger open-AddBookDialog"><i class="fa fa-plus"></i>&nbspExpenses</button>
            </div>

            @include('frontend.transactions.income')
            @include('frontend.transactions.expense')

        </div>

        {{-- <div class="loader">
            <img src="{{ asset('images/loader.gif') }}" alt="">
        </div> --}}

        <table class="table room-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($transactions as $key => $transaction)
                
                        <tr
                            class="{{ $transaction->income_id ? 'table-success' : ($transaction->bill_id ? 'table-success' : ($transaction->saving_id ? 'table-primary' : 'table-danger')) }}">
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                                @if (isset($transaction->bill_id))
                                    Bill ( {{ $transaction->bills->qr_code }})
                                @elseif (isset($transaction->expense_id))
                                    {{ $transaction->expenses->title }}
                                @elseif (isset($transaction->saving_id))
                                    {{ $transaction->savings->bank_name }}
                                @elseif(isset($transaction->income_id))
                                    {{ $transaction->incomes->name }}
                             
                                @endif
                            </td>
                            <td>
                                Rs.{{ $transaction->amount }}/-
                            </td>
                        </tr>
                   

                @empty
                    <tr>
                        <td colspan="3" class="text-center text-danger"> No Transactions found</td>
                    </tr>
                @endforelse

            </tbody>





        </table>

        {{ $transactions }}

    </div>
@endsection
@section('js')
    <script>
        //For Transactions
        const calculatetotal = function(data) {
            var quantity = $("#other_quantity").val();
            var total = quantity * data;
            $("#other_total").val(total)

        };

        $("#other_income").change(function() {
          
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
            var incomeTitle = $('#other option:selected').text();
            
            if(incomeTitle == 'EDV'){
                newTotal = (parseInt(currRate) + quantity * 100) - 100
                $("#other_total").val(newTotal);
            }else{
                var totaldd = quantity * currRate;
            $("#other_total").val(totaldd);
            }
          
            

        });

        $("#other_cash_received").on('keyup', function() {
            var cashReceived = $(this).val();
            var total = $("#other_total").val();
            var cashReturn = cashReceived - total;
            $("#other_cash_return").val(cashReturn);
        });
    </script>
@endsection



