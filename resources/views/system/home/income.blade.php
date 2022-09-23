<h1> Rs.{{ collect($income)->sum('amount') }}</h1>


<h2> Transactions</h2>
<ul class="list-group">
    @foreach ($income as $key => $i)
        <li class="list-group-item list-group-item-success">{{ $key + 1 }}. Rs.{{ $i->amount }} collected from
            {{ $i->type }} </li>
    @endforeach

</ul>
