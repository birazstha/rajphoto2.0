@include('frontend.include.header')

<div class="container-fluid" style="padding: 0 2rem 0 2rem">
    @yield('main-content')
</div>

@yield('js')

<script>
    // const themeMode = localStorage.getItem('dark-theme') || false;
    // toggleThemeMode(themeMode)

    // $(document).on('click', '.dark-mode', function() {
    //     let mode = localStorage.getItem('dark-theme')
    //     if (mode == "" || mode == null) {
    //         localStorage.setItem('dark-theme', true);
    //     } else if (mode == 'false') {
    //         localStorage.setItem('dark-theme', true);
    //     } else {
    //         localStorage.setItem('dark-theme', false);
    //     }
    //     mode = localStorage.getItem('dark-theme')
    //     toggleThemeMode(mode);
    // });

    // function toggleThemeMode(mode) {
    //     if (mode === 'true') {
    //         $('body').css("background-color", '#151515');
    //         $('.form').css("background-color", '#eaeaea');
    //         $('.table-bills').css('background', '#b3b3b3');
    //         $('.dark-mode-btn').html('<i class="far fa-lightbulb dark-mode ml-2" data-mode="light"></i>');
    //     } else {
    //         $('body').css("background-color", '#cccccc');
    //         $('.dark-mode-btn').html('<i class="fas fa-lightbulb dark-mode ml-2" data-mode="dark"></i>   ');
    //         $('.table-bills').css('background', 'white');

    //         $('.form').css("background-color", 'white');
    //     }
    // }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script src="http://benalman.com/code/projects/jquery-throttle-debounce/jquery.ba-throttle-debounce.js"></script>
<script src="{{ asset('public/compiledCssAndJs/js/currentDate.js') }}"></script>







<script>
    $(".search").autocomplete({
        classes: {
            "ui-autocomplete": "highlight",
        },
        source: function(request, response) {
            $.ajax({
                url: "{{ route('autoCompleteSearch') }}",
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    if (data.length > 0) {
                        console.log(data);
                        response(data.slice(0, 6));
                    } else {
                        response([{
                            label: 'No data found.'
                        }]);
                    }
                }
            });
        },
        select: function(event, ui) {
            $('.search').val(ui.item.label);
            let id = ui.item.id;
            let url = "{{ route('customerResult', ['id' => ':id']) }}";
            let finalUrl = url.replace(':id', id);
            window.location.href = finalUrl;
            return false;
        },
        delay: 100
    });

    //Tooltip
    $(function() {
        $('.html-tooltip').tooltip();
    });
</script>







</body>

</html>
