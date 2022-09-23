@extends('frontend.layout.master')
@section('main-content')
    <div class="tab-slider--nav">
        <ul class="tab-slider--tabs">
            <li class="tab-slider--trigger active" rel="tab1">Tab 1</li>
            <li class="tab-slider--trigger" rel="tab2">Tab 2</li>
        </ul>
    </div>
    <div class="tab-slider--container">
        <div id="tab1" class="tab-slider--body">
            <h2>Tab 1</h2>
            <p>Tab 1 content</p>
        </div>
        <div id="tab2" class="tab-slider--body">
            <h2>Tab 2</h2>
            <p>Tab 2 content</p>
        </div>
    </div>
@endsection

@section('js')
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
    </script>
@endsection
