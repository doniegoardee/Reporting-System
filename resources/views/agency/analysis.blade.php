<x-agency-layout>

    <div class="container">
        <h1>Agency Report Analysis</h1>

        <!-- Display Report Statuses and their Counts -->
        <table class="table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>In Progress</td>
                    <td>{{ $inProgressCount }}</td>
                </tr>
                <tr>
                    <td>Resolved</td>
                    <td>{{ $resolvedCount }}</td>
                </tr>
                <tr>
                    <td>Closed</td>
                    <td>{{ $closedCount }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Display Chart -->
        <div class="mt-4">
            <h3>Report Status Distribution</h3>
            <canvas id="reportStatusChart"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('reportStatusChart').getContext('2d');
            var reportStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['In Progress', 'Resolved', 'Closed'],
                    datasets: [{
                        label: 'Report Statuses',
                        data: [
                            {{ $inProgressCount }},
                            {{ $resolvedCount }},
                            {{ $closedCount }}
                        ],
                        backgroundColor: ['#f39c12', '#27ae60', '#e74c3c'],
                        borderColor: ['#f39c12', '#27ae60', '#e74c3c'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>

    <style>
        /* Apply a fixed size to the canvas */
        #reportStatusChart {
            width: 500px !important;
            height: 500px !important;
        }
    </style>

</x-agency-layout>
