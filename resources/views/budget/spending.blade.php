<x-header />
<section class="section-full" style="padding-top:5rem;">
    <div class="container">
        <div style="margin-bottom:1em;">
            @if($expenses !== [])
                <h1>{{Carbon\Carbon::now()->format('F')}} Spending: ${{$totalSpending}}</h1>
            </div>
                    @foreach($dates as $date)
                        <div style="margin-bottom:0.5em;">
                            <p style="width: 100%; color:var(--main-green); font-weight:700;">
                                {{$date->format('F')}}
                                {{$date->format('d')}} - 
                                {{$date->format('l')}}
                            </p>
                            @foreach($expenses as $expense)
                            @if (Carbon\Carbon::parse($expense['created_at'])->toDateString() === $date->toDateString())
                            <div style="width: 90%; display:flex; justify-content:space-between;">
                                <span>{{$expense['what']}}</span>
                                <span>${{$expense['amount']}}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    @endforeach
        @else
            <p>You have no expenses this month.</p>
        @endif
    </div>
</section>
<x-footer />
