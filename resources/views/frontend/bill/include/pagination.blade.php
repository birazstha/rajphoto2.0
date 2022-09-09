
 <div class="d-flex justify-content-between">
    <div class="">
        @foreach ($bills as $key => $bill )
            @if ($key==0)
            Showing {{ $bill->id }} to
            @endif

            @if($key == $dataCount - 1 )
                {{ $bill->id }} entries of {{ $totalBill }} entires
            @endif
        @endforeach
    </div>
    @if ($dataCount >= 10)

        <ul class="pagination">
            <li class="page-item previous" data-type="previous"><a class="page-link" href="">Previous</a></li>
             <li class="page-item" data-type="next"><a class="page-link" href="http://127.0.0.1:8000?page=4">Next</a></li>
        </ul>
    @endif
</div>