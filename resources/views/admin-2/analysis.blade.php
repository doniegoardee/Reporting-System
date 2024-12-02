<x-app-layout>
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

        .chartjs-legend li.underline {
        text-decoration: underline;
    }
    </style>


    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Analysis</h2>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Incident Report Summary</h5>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('admin-2.analysis') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="month" class="form-control">
                                    <option value="">All Months</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}"
                                            {{ request('month') == $m ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="year" class="form-control">
                                    <option value="">All Years</option>
                                    @foreach (range(date('Y'), date('Y') - 10) as $y)
                                        <option value="{{ $y }}"
                                            {{ request('year') == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

                    @if ($reportCountByType->isEmpty())
                        <div class="alert alert-warning">
                            No analysis for {{ $selectedMonth }} {{ $selectedYear }}.
                        </div>
                    @else
                        <!-- Table showing the report analysis -->
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

                        <div class="row mt-4 d-flex align-items-start">
                            <div class="col-md-8 col-12">
                                <div class="chart-container" style="width: 100%; max-width: 100%; margin: auto; height: 600px;">
                                    <canvas id="incidentTypeChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="chart-container" style="width: 100%; max-width: 100%; margin: auto; height: 600px;">
                                    <canvas id="incidentTypeChart-pie"></canvas>
                                </div>
                            </div>
                        </div>


                    @endif
                </div>
            </div>

            <script>
                var ctx = document.getElementById('incidentTypeChart').getContext('2d');

                var reportCountByType = @json($reportCountByType);

                var labels = reportCountByType.map(function(report) {
                    return report.subject_type;
                });

                var data = reportCountByType.map(function(report) {
                    return report.count;
                });

                var backgroundColors = reportCountByType.map(function(report) {
                    return report.color || '#ff6384';
                });

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Incident Types',
                            data: data,
                            backgroundColor: backgroundColors,
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                align: 'start',
                                labels: {
                                    generateLabels: function(chart) {
                                        var labels = chart.data.labels;
                                        var data = chart.data.datasets[0].data;
                                        return labels.map((label, index) => ({
                                            text: `${label} = ${data[index]}`,
                                            fillStyle: backgroundColors[index],
                                            strokeStyle: backgroundColors[index],
                                            hidden: false,
                                            index: index
                                        }));
                                    },
                                    boxWidth: 15,
                                    font: {
                                        size: 14,
                                        family: 'Arial'
                                    },
                                    color: '#333'
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let value = tooltipItem.raw;
                                        return `${tooltipItem.label}: ${value} incidents`;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Incident Types',
                                    font: { size: 14 }
                                },
                                ticks: {
                                    font: { size: 12 }
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Number of Incidents',
                                    font: { size: 14 }
                                },
                                ticks: {
                                    font: { size: 12 },
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                });
            </script>

            <script>
                var ctxPie = document.getElementById('incidentTypeChart-pie').getContext('2d');

                var backgroundColorsPie = @json($reportCountByType->map(function($report) use ($colorMap) {
                    return $colorMap[$report->subject_type] ?? '#ff6384'; // Fallback color
                }));

                var chartPie = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: @json($reportCountByType->pluck('subject_type')),
                        datasets: [{
                            label: 'Incident Types',
                            data: @json($reportCountByType->pluck('count')),
                            backgroundColor: backgroundColorsPie,
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'right',
                                align: 'start',
                                labels: {
                                    generateLabels: function(chart) {
                                        var labels = chart.data.labels;
                                        var data = chart.data.datasets[0].data;
                                        return labels.map((label, index) => ({
                                            text: `${label} = ${data[index]}`,
                                            fillStyle: backgroundColorsPie[index],
                                            strokeStyle: backgroundColorsPie[index],
                                            hidden: false,
                                            index: index
                                        }));
                                    },
                                    boxWidth: 15,
                                    font: {
                                        size: 14,
                                        family: 'Arial'
                                    },
                                    color: '#333',
                                    onClick: function(event, legendItem) {
                                        var index = legendItem.index;
                                        var meta = chartPie.getDatasetMeta(0);
                                        var item = meta.data[index];

                                        var alreadyUnderlined = item._model.textDecoration === 'underline';
                                        item._model.textDecoration = alreadyUnderlined ? '' : 'underline';
                                        chartPie.update();
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        let value = tooltipItem.raw;
                                        return `${tooltipItem.label}: ${value} incidents`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>


        </div>

</x-app-layout>
