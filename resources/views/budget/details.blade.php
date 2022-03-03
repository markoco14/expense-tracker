<x-header />
    <x-navbar />
    <div class="col-sm-6 offset-sm-3">
        <h1>Expense Tracker App</h1>
        <h2>Budget List</h2>
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
                <tr>
                    <td>LI</td>
                    <td>${{$labourInsurance}}</td>
                </tr>
                <tr>
                    <td>NHI</td>
                    <td>${{$nationalHealthInsurance}}</td>
                </tr>
                <tr>
                    <td>Take Home Pay</td>
                    <td>${{$takeHomePay}}</td>
                </tr>
                <tr>
                    <td>Rent</td>
                    <td>${{$rent}}</td>
                </tr>
                <tr>
                    <td>Utilities</td>
                    <td>${{$utilities}}</td>
                </tr>
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
<x-footer />
