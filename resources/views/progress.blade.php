<x-header />
    <x-navbar />
    <div>
        {{-- {{dd($expenses)}} --}}
        <div class="col-sm-6 offset-sm-3">
            <h1>Hello, welcome to progress.</h1>
            <p>You have spent ${{$expenses[0]}} so far today.</p>
            <p>Your daily budget is ${{$budget}}.</p>
            <p>You have ${{$remaining}} left to spend today.</p>
            <p>You have spent ${{$percent}}% of your daily budget.</p>
            @if ($percent > 100)
                <p>Woah, dude. You have spent way too much money today. Try to have more self control.</p>
            @else
                <p>You're doing pretty decent today. Just don't spend too much more.</p>
            @endif
        </div>
    </div>
<x-footer />