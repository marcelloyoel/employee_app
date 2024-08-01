console.log('this is our time');


document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('doughnut1').getContext('2d');


    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut', // Specifies the type of chart
        data: {
            labels: ['New Customers', 'Loyal Customers'], // Labels for the chart
            datasets: [{
                label: 'Customer Status',
                data: [newCustJs, loyalCustJs], // Data values, replace with your own data
                backgroundColor: [
                    'rgba(40, 167, 69, 1)',   // Solid green
                    'rgba(0, 123, 255, 1)',  // Solid blue
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',   // Solid green border
                    'rgba(0, 123, 255, 1)',  // Solid blue border
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var ctx2 = document.getElementById('pieChart1').getContext('2d');

    // Check if a Chart instance already exists on this canvas
    if (ctx2.chart) {
        ctx2.chart.destroy();
    }

    // Create the new Chart instance
    var myPieChart = new Chart(ctx2, {
        type: 'pie', // Specifies the type of chart
        data: {
            labels: ['New Customers', 'Loyal Customers'], // Labels for the chart
            datasets: [{
                label: 'Customer Status',
                data: [newCustJs, loyalCustJs], // Data values, replace with your own data
                backgroundColor: [
                    'rgba(0, 123, 255, 1)',  // Solid blue
                    'rgba(40, 167, 69, 1)'   // Solid green
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)',  // Solid blue border
                    'rgba(40, 167, 69, 1)'   // Solid green border
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });

    // Store the Chart instance on the canvas element
    ctx2.chart = myPieChart;
});

