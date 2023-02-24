<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/f0dad6a07d.js" crossorigin="anonymous"></script>
    <link href="{{ asset('public/compiledCssAndJs/css/system.css') }}" rel="stylesheet" media="screen">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"
        integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"
        integrity="sha256-H2TaUgwe8vbd8Uf3Pki5UcggDC05eieuDNDCjzEngWU=" crossorigin="anonymous"></script>
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- Localhost --}}
    <link rel="stylesheet" href="{{ asset('public/adminLte/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/css/frontend/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/frontend/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/frontend/dashboard.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/css/frontend/bill.css') }}" media="all" /> --}}
    <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v3.7.min.css"
        rel="stylesheet" type="text/css" />

    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


    {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicon/apple-touch-icon.png') }}"> --}}
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicon/favicon-32x32.png') }}"> --}}
    <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('public/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('public/favicon/site.webmanifest') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Raj Photo Studio - {{ $pageTitle ?? '' }}</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v3.7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/compiledCssAndJs/js/nepali-date.js') }}"></script>


    <style>
        .ui-autocomplete {
            z-index: 2147483647;
        }
    </style>
</head>

<body>

    <header>

        <div class="logo-nav">
            <a href="{{ route('home') }}">
                {{-- <img src="{{ asset('logo.png') }}" alt="logo"> --}}
                <img src="{{ asset('public/logo.png') }}" alt="logo">
            </a>
            <nav>
                <ul>
                    @if (request()->segment(1))
                        <li>
                            <a href="{{ route('home') }}" class="">Home<a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('home') }}" class="active-link">Home</a>
                        </li>
                    @endif
                    <li><a href="{{ route('bills.create') }}"
                            class="{{ request()->segment(1) === 'bills' ? 'active-link' : '' }}">Bill</a> </li>

                    {{-- <li><a href="{{ route('transactions.income') }}"
                            class="{{ request()->segment(1) === 'income' ? 'active-link' : '' }}">Income</a> </li>
                    <li><a href="{{ route('transactions.expense') }}"
                            class="{{ request()->segment(1) === 'expense' ? 'active-link' : '' }}">Expense</a> </li> --}}

                    <li>
                        <a class="dropdown-toggle {{ request()->segment(1) === 'income' ? 'active-link' : '' }} {{ request()->segment(1) === 'income' ? 'active-link' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Income
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($orders as $order)
                                <li><a class="dropdown-item "
                                        href="{{ route('transactions.income', ['incomeId' => $order->id]) }}">{{ $order->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    <li>
                        <a class="dropdown-toggle {{ request()->segment(1) === 'expense' ? 'active-link' : '' }} {{ request()->segment(1) === 'expense' ? 'active-link' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Expense
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($expenses as $expense)
                                <li><a class="dropdown-item "
                                        href="{{ route('transactions.expense', ['expenseId' => $expense->id]) }}">{{ $expense->title }}</a>
                                </li>
                            @endforeach

                        </ul>

                    </li>



                    <li>
                        <a class="dropdown-toggle {{ request()->segment(1) === 'bank' ? 'active-link' : '' }} {{ request()->segment(1) === 'bank' ? 'active-link' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Savings
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($savings as $saving)
                                <li><a class="dropdown-item "
                                        href="{{ route('bank.index', ['bankId' => $saving->id]) }}">{{ $saving->bank_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    {{-- <li><a href="{{ route('analytics') }}"
                            class="{{ request()->segment(1) === 'analytics' ? 'active-link' : '' }}">Analytics</a>
                    </li> --}}

                </ul>
            </nav>
        </div>

        <div class="w-25 search-setting">

            <input class="form-control mr-4 search" placeholder="Search Customer" type="text" autocomplete="off">

            <a href="{{ route('home.system') }}" target="_blank">
                <i class="fas fa-cog" style="color: white; font-size:20px"></i>
            </a>
        </div>

    </header>
