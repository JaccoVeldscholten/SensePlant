$(document).ready(function() {
    function createCharts() {
        $.getJSON("api/plantdata/1", function (data) {
            createMoodChart(data);
            createTempChart();
            createWaterChart();
        });
    }

    function createMoodChart(plantData) {
        console.log(plantData);

        var ctx = document.getElementById("moodChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
    }

// getSenseData();
    createCharts();
// createTempChart();
// createWaterChart();
});
