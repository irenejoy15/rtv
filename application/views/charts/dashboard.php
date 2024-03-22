<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {

        labels: [<?php echo $labels;?>],
        datasets: [
        {
          label               : 'MONITORING',
          backgroundColor     : '#dc3545',
          borderColor         : '#dc3545',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $results;?>]
        },]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
                labels: {
                    fontColor: "#6c757d",
                    fontSize: 18
                }
            },
        scales: {
            yAxes: [{
                stacked: true,
                ticks: {
                    beginAtZero: false,
                    fontColor: "#869099",
                    fontSize: 14,
                    stepSize: 10,

                }
            }],
            xAxes: [{
                    ticks: {
                        fontColor: "#869099",
                        fontSize: 14,
                        stepSize: 1,
                        beginAtZero: false
                    }
                }]
        }
    }
});
</script>
