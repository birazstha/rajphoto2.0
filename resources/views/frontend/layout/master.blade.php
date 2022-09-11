@include('frontend.include.header')

<div class="container-fluid">
    @yield('main-content')
</div>


@yield('js')

<script>
    const themeMode = localStorage.getItem('dark-theme') || false;
    toggleThemeMode(themeMode)

    $(document).on('click', '.dark-mode', function() {
        let mode = localStorage.getItem('dark-theme')
        if(mode == "" || mode == null){
            localStorage.setItem('dark-theme', true);
        }else if(mode == 'false'){
            localStorage.setItem('dark-theme', true);
        }else{
            localStorage.setItem('dark-theme', false);
        }
        mode = localStorage.getItem('dark-theme')
        toggleThemeMode(mode);
    });

    function toggleThemeMode(mode){
        if(mode === 'true'){
            $('body').css("background-color", '#151515');
            $('.form').css("background-color", '#eaeaea');
            $('.table-bills').css('background','#b3b3b3');
            $('.dark-mode-btn').html('<i class="far fa-lightbulb dark-mode ml-2" data-mode="light"></i>');
        }else{
            $('body').css("background-color", '#cccccc');
            $('.dark-mode-btn').html('<i class="fas fa-lightbulb dark-mode ml-2" data-mode="dark"></i>   ');
            $('.table-bills').css('background','white');

            $('.form').css("background-color", 'white');
        }
    }
</script>
</body>

</html>
