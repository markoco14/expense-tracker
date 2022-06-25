<x-header />
<section class="section-full" style="padding-top:5rem;">
    <div class="container">
        <h1 class="form-title">Spending</h1>
        
        @if($expenses !== [])
            <p>June Total Spending: ${{$totalSpending}}</p>
            <table style="width: 100%">
                <thead>
                    <tr style="text-align: left;">
                        <th>Amount</th>
                        <th>What</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                    <tr>
                        <td>{{$expense['amount']}}</td>
                        <td>{{$expense['what']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You have no expenses this month.</p>
        @endif
    </div>
</section>
<x-footer />
