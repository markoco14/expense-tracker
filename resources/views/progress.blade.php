<x-header />
@if(Auth::check())
    <script>
        let username = "{{ Auth::user()->username }}";
        let userId = "{{ Auth::user()->id }}";
    </script>
@endif
<section class="section-full">
    <div class="container" style="padding-top:5rem;">
        <h1 class="form-title">Progress {{$today->format('F')}} {{$today->day}}</h1>
        <article class="progress-container">
            <div class="progress-row">
                <div class="progress-card">
                    <div class="chart-overlay">
                        @if ($percent > 100 || $percent < 0)
                        <div>
                            <p class="loss">{{round($percent,0)}}%</p>
                        </div>
                        @else 
                        <div>
                            <p class="gain">{{round($percent,0)}}%</p>
                        </div>
                        @endif
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="progress-row">
                <div class="progress-info">
                    <p class="progress-label">You spent </p> 
                    @if ($budget - $remaining > $budget )
                    <p class="loss progress-stat">${{$budget - $remaining}}</p>
                    @else
                    <p class="gain progress-stat">${{$budget - $remaining}}</p>
                    @endif
                </div>
                <div class="progress-info">
                    <p class="progress-label">You have </p>
                    @if ($remaining < 0)
                    <p class="loss progress-stat">$0</p>
                    @else
                    <p class="gain progress-stat">${{$remaining}}</p>
                    @endif
                </div>
            </div>
        </article>
        <table class="progress-table">
            <thead>
                <tr>
                    <th>Your Daily Progress</th>
                    <th>{{$today->format('F')}} {{$today->day}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Budget</td>
                    <td style="text-align: right;">${{$budget}}</td>
                </tr>
                @if ($expenses !== [])
                    @foreach ($expenses as $key => $value)
                    <tr>
                        <td>
                            Expense {{$key + 1}}
                        </td>
                        <td style="text-align: right;">
                            ${{$value}}
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td>
                            Expenses
                        </td>
                        <td style="text-align: right;">
                            $0
                        </td>
                    </tr>
                @endif
                <tr>
                    <td>Remaining</td>
                    @if ($remaining < 0)
                    
                    <td style="text-align: right;">$0</td>
                    @else
                    <td style="text-align: right;">${{$remaining}}</td>
                    @endif
                </tr>
                <tr>
                    @if ($remaining < 0)
                        <td>Overspend</td>
                        <td style="text-align: right;" class="loss">${{$remaining * -1}}</td>
                        @else
                        <td>Saving</td>
                        <td style="text-align: right;" class="gain">${{$remaining}}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</section>
    <script async>
        async function fetchData () {
            const response = await fetch(`api/percent`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            });
            const data = await response.json();
            return data;
        }
        fetchData().then(data => {
            const totalSpent = data.totalSpent;
            const dailyBudget = data.budgetAmount;

            if (totalSpent === 0 && dailyBudget === 0) {
                data = {
                    datasets: [{
                        label: '% of Budget Spent',
                        data: [0, 100],
                        backgroundColor: [
                            'rgba(63, 145, 74, 1)',
                            'rgba(63, 145, 74, 0.2)',
                        ],
                        hoverOffset: 4,
                        cutout: '80%',
                    }]
                };
            } else if (totalSpent <= dailyBudget) {
                data = {
                    datasets: [{
                        label: '% of Budget Spent',
                        data: [totalSpent, (dailyBudget-totalSpent)],
                        backgroundColor: [
                            'rgba(63, 145, 74, 1)',
                            'rgba(63, 145, 74, 0.2)',
                        ],
                        hoverOffset: 4,
                        cutout: '80%',
                    }]
                };
            } else {
                data = {
                    datasets: [{
                        label: '% of Budget Spent',
                        data: [100, 0],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        hoverOffset: 4,
                        cutout: '80%',
                    }]
                };
            }
            myChart.config.type = 'doughnut';
            myChart.config.data = data;
            myChart.update();
        });

        const labels = [
            'Spent',
            'Remaining',
        ];
        
        const data = {
            // labels: labels,
            datasets: [{
                label: '% of Budget Spent',
                data: [0, 100],
                backgroundColor: [
                    'rgba(63, 145, 74, 1)',
                    'rgba(63, 145, 74, 0.2)',
                ],
                hoverOffset: 4,
                cutout: '80%',
            }],
        };
        
        const config = {
            type: 'doughnut',
            data: data,
        };
        
    </script>
    <script async defer>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script>
<x-footer />