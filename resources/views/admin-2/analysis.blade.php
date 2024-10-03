<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin-2.contents.css')

    <style>
        .chart-container {
            position: relative;
            height: 300px;

            width: 100%;
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 250px;

            }
        }
    </style>
</head>

<body>

    @include('admin-2.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin-2.contents.sidebar')

        <!-- Sidebar Navigation end-->

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Analysis</h2>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Incident Report Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportCountByType as $report)
                                <tr>
                                    <td>{{ $report->subject_type }}</td>
                                    <td>{{ $report->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="chart-container">
                                <canvas id="incidentTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin-2.contents.footer')

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            <script>
                var ctx = document.getElementById('incidentTypeChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: @json($reportCountByType->pluck('subject_type')),
                        datasets: [{
                            label: 'Incident Types',
                            data: @json($reportCountByType->pluck('count')),
                            backgroundColor: [
                                '#ff6384',
                                '#36a2eb',
                                '#ffce56',
                                '#4bc0c0',
                                '#9966ff'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    boxWidth: 12,
                                    font: {
                                        size: 14
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>

</body>

</html>