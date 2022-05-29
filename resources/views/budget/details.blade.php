<x-header />
<section class="section-full">

    <x-navbar />
    <div class="container">
        <h1 class="form-title">Expense Tracker App</h1>
        <p>Budget List for {{Carbon\Carbon::now()->format('F')}}</p>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monthly Salary</td>
                    <td>${{$monthlySalary}}</td>
                </tr>
                <tr>
                    <td>Deductions</td>
                    <td>${{$deductions}}</td>
                </tr>
                {{-- {{dd($allDeductions)}} --}}
                @foreach ($allDeductions as $deduction)
                <tr>
                    <td>{{$deduction['deduction_name']}}</td>
                    <td>${{number_format($deduction['deduction_amount'])}}</td>
                </tr>
                @endforeach
                {{-- <tr>
                    <td>LI</td>
                    <td>${{$labourInsurance}}</td>
                </tr>
                <tr>
                    <td>NHI</td>
                    <td>${{$nationalHealthInsurance}}</td>
                </tr> --}}
                {{-- 
                    comment out take home pay for now. 
                    need to fix up some stuff with the deductions form
                    once I have types, I can get THP and go from there
                --}}
                {{-- <tr>
                    <td>Take Home Pay</td>
                    <td>${{$takeHomePay}}</td>
                </tr> --}}
                {{-- <tr>
                    <td>Rent</td>
                    <td>${{$rent}}</td>
                </tr>
                <tr>
                    <td>Utilities</td>
                    <td>${{$utilities}}</td>
                </tr> --}}
                <tr>
                    <td>Savings</td>
                    <td>${{$savings}}</td>
                </tr>
                <tr>
                    <td>Before Daily Expenses</td>
                    <td>${{$beforeDailyExpenses}}</td>
                </tr>
                <tr>
                    <td>Total Daily Budget</td>
                    <td>${{$totalDailyBudget}}</td>
                </tr>
                <tr>
                    <td>Surplus</td>
                    <td>${{$surplus}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<x-footer />
