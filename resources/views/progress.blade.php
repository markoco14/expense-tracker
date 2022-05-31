<x-header />
@if(Auth::check())
    <script>
        let username = "{{ Auth::user()->username }}";
    </script>
@endif
<section class="section-full">
    <x-navbar />
    <div class="container">
        <h1 class="form-title">Today's Progress</h1>
        @if ($percent > 100)
            <p>Woah, dude. You have spent way too much money today. Try to have more self control.</p>
        @else
            <p>You're doing pretty decent today. Just don't spend too much more.</p>
        @endif
        <div >
            <div >{{$today->format('F')}} {{$today->day}}</div>
        </div>
        <div class="progress-row">
            <div class="progress-card">
                <p>Day's Total</p> 
                @if ($budget - $remaining > $budget )
                    <p style="color: red; font-size:2rem; text-align: center;">${{$budget - $remaining}}</p>
                @else
                    <p style="color: green; font-size:2rem; text-align: center;">${{$budget - $remaining}}</p>
                @endif
            </div>
            <div class="progress-card">
                <p>Percent of Budget</p>
                @if ($percent > 100)
                <p class="loss"{$percent}}%</p>
                @else 
                <p class="gain">{{$percent}}%</p>
                @endif
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="progress-row">
            <div class="progress-card">
                <p>Money left</p>

                @if ($remaining < 0)
                <p class="loss">$0</p>
                @else
                <p class="gain">${{$remaining}}</p>
                @endif

            </div>
            <div class="progress-card">
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
        <table>
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
                    <td style="text-align: right;">${{$value}}</td>
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
                        <td>${{$remaining * -1}}</td>
                        @else
                        <td>Saving</td>
                        <td>${{$remaining}}</td>
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
            return data;
        }
        
        fetchData().then(data => {
            const totalSpent = data;
            data = {
                datasets: [{
                    label: '% of Budget Spent',
                    data: [totalSpent, (500-totalSpent)],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    hoverOffset: 4
                }]
            };
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
                    'rgb(255, 99, 132)',
                    'rgba(255, 99, 132, 0.2)',
                    // 'rgb(255,255,255)'
                ],
                hoverOffset: 4
            }]
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