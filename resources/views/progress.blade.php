<x-header />
@if(Auth::check())
    <script>
        let username = "{{ Auth::user()->username }}";
    </script>
@endif
<x-mobile-nav/>
<section class="section-full">
    {{-- <x-navbar /> --}}
    <div class="container" style="padding-top:5rem;">
        <h1 class="form-title">Progress {{$today->format('F')}} {{$today->day}}</h1>
        <div class="progress-row">
            <div class="progress-card">
                <div class="chart-overlay">
                    @if ($percent > 100)
                    <div>
                        <p class="loss">{{$percent}}%</p>
                    </div>
                    @else 
                    <div>
                        <p class="gain">{{$percent}}%</p>
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
        {{-- </div>
        <div class="progress-row"> --}}
            <div class="progress-info">
                <p class="progress-label">You have </p>
                @if ($remaining < 0)
                <p class="loss progress-stat">$0</p>
                @else
                <p class="gain progress-stat">${{$remaining}}</p>
                @endif
            </div>
        </div>
        {{-- <div class="progress-row">
            <div class="progress-card">
                <p>Extra</p>
            </div>
        </div> --}}
        <table>
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
                @foreach ($expenses as $key => $value)
                <tr>
                    <td>Expense {{$key + 1}}</td>
                    <td style="text-align: right;">${{$value}}</td>
                </tr>
                @endforeach
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
            const response = await fetch(`api/percent/${username}`);
            const data = await response.json();
            console.log(data);
            return data;
        }
        
        fetchData().then(data => {
            const totalSpent = data;
            if (totalSpent <= 500) {
                data = {
                    datasets: [{
                        label: '% of Budget Spent',
                        data: [totalSpent, (500-totalSpent)],
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