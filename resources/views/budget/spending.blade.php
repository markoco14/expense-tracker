<x-header />
    <x-navbar />
    <div class="col-sm-6 offset-sm-3">
        <h1>Expense Tracker App</h1>
        <p>Here is a record of your daily spending</p>
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
<x-footer />
