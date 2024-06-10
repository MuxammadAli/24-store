

var chartt = new Chart($("#count-chart"), {
    type: 'line',
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'top',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: '#dae1e7',
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: '#dae1e7',
                },
                scaleLabel: {
                    display: true,
                }
            }]
        }
    },
    data: []
});

var chart_pricee = new Chart($("#price-chart"), {
    type: 'line',
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'top',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: '#dae1e7',
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: '#dae1e7',
                },
                scaleLabel: {
                    display: true,
                }
            }]
        }
    },
    data: []
});

function chart_price(data) {
    chart_pricee.data = data;
    chart_pricee.update();
}

function chart(data) {
    chartt.data = data;
    chartt.update();
}







