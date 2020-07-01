<canvas id="doughnut" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'bar',
        data: {
            labels: ["{!! implode('","', $users) !!}"],
            datasets: [{
                label: '上班',
                data: ["{!! implode('","', $punch_start_today) !!}"],
                backgroundColor: [
                    @foreach($users as $user)
                        'rgba(54, 162, 235, 0.2)',
                    @endforeach
                ],
                borderColor: [
                    @foreach($users as $user)
                        'rgba(54, 162, 235, 1)',
                    @endforeach
                ],
                borderWidth: 1
                }, {
                label: '下班',
                data: ["{!! implode('","', $punch_end_today) !!}"],
                backgroundColor: [
                    @foreach($users as $user)
                        'rgba(75, 192, 192, 0.2)',
                    @endforeach
                ],
                borderColor: [
                    @foreach($users as $user)
                        'rgba(75, 192, 192, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 12,
                        stepSize: 2
                    }
                }]
            }
        }
    };

    var ctx = document.getElementById('doughnut').getContext('2d');
    new Chart(ctx, config);
});
</script>
