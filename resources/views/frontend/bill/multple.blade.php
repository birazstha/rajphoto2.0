@section('main-content')

    <div class="container mt-5">
        <form method="POST" action="{{ url('add-multi-values') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-info">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <table class="table" id="multiForm">
                <tr>
                    <th>Add Hobbies</th>
                    <th>Remove</th>
                </tr>
                <tr>
                    <td><input type="text" name="multiInput[0][hobbies]" class="form-control"/></td>
                    <td><input type="button" name="add" value="Add" id="addRemoveIp" class="btn btn-outline-dark"></td>
                </tr>
            </table>

            <div class="d-grid mt-3">
                <input type="submit" class="btn btn-dark btn-block" value="Submit">
            </div>
        </form>
    </div>
@endsection

@section('js')
    @include($base_route.'include.script')
    @include($base_route.'include.add_row_script')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        var i = 0;
        $("#addRemoveIp").click(function () {
            ++i;
            $("#multiForm").append('<tr><td><input type="text" name="multiInput['+i+'][hobbies]" class="form-control" /></td><td><button type="button" class="remove-item btn btn-danger">Delete</button></td></tr>');
        });
        $(document).on('click', '.remove-item', function () {
            $(this).parents('tr').remove();
        });
    </script>
@endsection

@include('frontend.layout.master')



