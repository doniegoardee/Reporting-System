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

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="chart-container">
                                    <canvas id="incidentTypeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

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

</x-app-layout>
