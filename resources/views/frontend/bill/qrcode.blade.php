@section('main-content')

    <form class="d-flex" action="{{ route('bill.search') }}">
        @csrf
        <input class="form-control me-2" type="text" name="qrcode" id="qrcode" placeholder="Scan Qr Code" aria-label="Search">
    </form>
    @error('id')
    <p>
        {{$message}}
    </p>
    @enderror

@endsection

@section('js')
    {{-- @include($base_route.'include.script') --}}
@endsection

@include('frontend.layout.master')


