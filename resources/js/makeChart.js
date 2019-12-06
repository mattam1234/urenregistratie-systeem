var Chart = require('chart.js');
var ctx = document.getElementById('myChart');
myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [10, 20, 30],
            labels: [
                'Red',
                'Yellow',
                'Blue'
            ]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs

    },
    options: Chart.defaults.doughnut
});


