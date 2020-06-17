<canvas id="doughnut" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'bar',
        data: {
            labels: ["{!! implode('","', $users) !!}"],
            datasets: [{
                label: '上班',
                data: [7.5, 9, 10],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
                }, {
                label: '下班',
                data: [5, 6, 4],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 192, 1)'
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
                        max: 12
                    }
                }]
            }
        }
    };

    var ctx = document.getElementById('doughnut').getContext('2d');
    new Chart(ctx, config);
});
</script>
