@extends('frontend.layout.master')
@section('main-content')


<div class="mb-4">
<form class="d-flex">
    @csrf
      <div class="input-group input-group">
        <input type="text" class="form-control customerName" placeholder="Enter a custome's name">
        <span class="input-group-append">
            <input type="text" value="" name="todays-date" class="form-control text-center" id="todays-date">
        </span>
      </div>

</form>
</div>


    <div class="table">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Ordered Date</th>
                        <th>Delivery Date</th>
                        {{-- <th>Order</th>
                        <th>Size</th>
                        <th>Quantity</th> --}}
                        <th>Total</th>
                        <th>Advance</th>
                        <th>Balance Amount</th>
                        <th>Prepared By</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody class="allData">
                   

                  
                </tbody>

                <tbody id="content"></tbody>
            </table>

        </div>

    </div>
@endsection


@section('js')
<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"
type="text/javascript"></script>
<script src="http://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>

@include('frontend.bill.include.filter')
@include('frontend.bill.include.scripts.nepalidate')
@endsection

