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


$(document).ready(function() {
    $('#customers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/customers/data',
            type: 'GET',
        },
        columns: [
            { data: 'user_id', name: 'user_id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            {
                data: 'status',
                name: 'status',
                render: function(data) {
                    console.log('Status Data:', data); // Debugging line
                    // if (data == 0) {
                    //     return '<span class="badge text-lg-center text-bg-success">New Customer</span>';
                    // } else {
                    //     return '<span class="badge text-lg-center text-bg-info">Loyal Customer</span>';
                    // }
                    return '<div class="text-center">' + data + '</div';
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data) {
                    let date = new Date(data);
                    return date.toLocaleString('en-GB', { timeZone: 'Asia/Bangkok' });
                }
            },
            {
                data: 'updated_at',
                name: 'updated_at',
                render: function(data) {
                    let date = new Date(data);
                    return date.toLocaleString('en-GB', { timeZone: 'Asia/Bangkok' });
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        initComplete: function(settings, json) {
            // Your custom code here
            console.log('DataTable initialized successfully!');
            // You can perform additional actions or setup after initialization.
            $('.atas').parent().addClass('text-center');
        }
    });
});
