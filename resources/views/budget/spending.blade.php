<x-header />
<section class="section-full">

    <x-navbar />
    <div class="container">
        <h1 class="form-title">Your Spending</h1>
        <p>Here is a record of your daily spending in {{Carbon\Carbon::now()->format('F')}}</p>
        <table>
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>What</th>
                    <th>Where</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                <tr>
                    <td>{{$expense->amount}}</td>
                    <td>{{$expense->what}}</td>
                    <td>{{$expense->where}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul>
        </ul>
    </div>
</section>
<x-footer />
