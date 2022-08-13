@section('main-content')

    <form class="d-flex" action="">
        @csrf
        <input class="form-control me-2" type="search" name="id" id="id" placeholder="Scan Qr Code" aria-label="Search">
{{--        <button class="btn btn-danger" type="submit"><i class="fas fa-search search-icon"></i></button>--}}

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


