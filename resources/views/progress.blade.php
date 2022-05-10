<x-header />
    <x-navbar />
    <div class="container bd-highlight">
        @if ($percent > 100)
            <p>Woah, dude. You have spent way too much money today. Try to have more self control.</p>
        @else
            <p>You're doing pretty decent today. Just don't spend too much more.</p>
        @endif
        <div class="row">
            <div class="col" style="background-color:white;">{{$today->format('F')}} {{$today->day}}</div>
        </div>
        <div class="row" style="min-height:10vh;">
            <div class="col card" style="background-color:white;">
                <p>Day's Total</p> 
                @if ($budget - $remaining > $budget )
                    <p style="color: red; font-size:2rem; text-align: center;">${{$budget - $remaining}}</p>
                @else
                    <p style="color: green; font-size:2rem; text-align: center;">${{$budget - $remaining}}</p>
                @endif
            </div>
            <div class="col card" style="background-color:white;">
                <p>Percent of budget spent</p>
                @if ($percent > 100)
                <p style="color:red; font-size:2rem; text-align: center;">{{$percent}}%</p>
                @else 
                <p style="color:green; font-size:2rem; text-align: center;">{{$percent}}%</p>
                @endif
            </div>
        </div>
        <div class="row" style="min-height:10vh;">
            <div class="col card" style="background-color:white;">
                <p>Money left</p>

                @if ($remaining < 0)
                <p style="color:red; font-size:2rem; text-align: center;">$0</p>
                @else
                <p style="color:green; font-size:2rem; text-align: center;">${{$remaining}}</p>
                @endif

            </div>
            <div class="col card" style="background-color:white;">
                <p>Extra</p>
                {{-- @php
                    // $monthSurplus = 900
                @endphp --}}
                {{-- @if ($monthSurplus > 0)
                <p style="color: green; font-size:2rem; text-align: center;">{{$monthSurplus}}</p>
                @else
                <p style="color: red; font-size:2rem; text-align: center;">{{$monthSurplus}}</p>
                @endif --}}
            </div>
        </div>
        <table class="table card" style="background-color:white;">
            <thead>
                <tr>
                    <th>Your Daily Progress</th>
                    <th>{{$today->format('F')}}</th>
                    <th>{{$today->day}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Budget</td>
                    <td>${{$budget}}</td>
                </tr>
                @foreach ($expenses as $key => $value)
                <tr>
                    <td>Expense {{$key + 1}}</td>
                    <td>{{$value}}</td>
                </tr>
                @endforeach
                <tr>
                    <td>Remaining</td>
                    @if ($remaining < 0)
                    
                    <td>$0</td>
                    @else
                    <td>${{$remaining}}</td>
                    @endif
                </tr>
                <tr>
                    @if ($remaining < 0)
                        <td>Overspend</td>
                        <td>{{$remaining * -1}}</td>
                        @else
                        <td>Saving</td>
                        <td>{{$remaining}}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
<x-footer />