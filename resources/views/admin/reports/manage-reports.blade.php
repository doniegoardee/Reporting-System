<!DOCTYPE html>
<html>

<head>
    @include('admin.contents.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body>
    @include('admin.contents.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->

        @include('admin.contents.sidebar')


        <!-- Sidebar Navigation end-->

        <div class="page-content">

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="mb-0">Reports</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Subject Type</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Description</th>
                                        {{-- <th class="text-center">Image</th> --}}
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $index => $report)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $report->subject_type }}</td>
                                            <td class="text-center">{{ $report->status }}</td>
                                            <td class="text-center">{{ $report->user_id }}</td>
                                            <td class="text-center">{{ $report->email }}</td>
                                            <td class="text-center">{{ $report->description }}</td>

                                            {{-- <td class="text-center">
                                                @if ($report->image)
                                                    <img src="{{ asset('image/' . $report->image) }}" width="50"
                                                        alt="Report Image">
                                                @endif
                                            </td> --}}
                                            <td class="text-center">

                                                {{-- View --}}
                                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $report->id }}">
                                                    {{-- <i class="fas fa-fw fa-magnifying-glass fs-5 me-3 text-success"></i> --}}
                                                    View
                                                </a>



                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('admin.update-status', ['id' => $report->id, 'status' => 'pending']) }}">Approve</a>

                                                <a href="{{ route('admin.update-status', ['id' => $report->id, 'status' => 'reject']) }}"
                                                    class="btn btn-danger btn-sm"
                                                    id="delete-btn-{{ $report->id }}">Reject</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            @foreach ($reports as $report)
                <div class="modal fade" id="exampleModal{{ $report->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-5">
                            <div class="modal-header">
                                <h5 class="modal-title fw-semibold " id="exampleModalLabel">Report
                                    Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- Add your appointment details here --}}
                                <p><b>Name:</b> {{ $report->name }}</p>
                                <p><b>Report Type:</b> {{ $report->subject_type }}</p>
                                <p><b>Location:</b> {{ $report->location }}</p>
                                <p><b>Description:</b> {{ $report->description }}</p>
                                <p><b>Image:</b>
                                    @if ($report->image)
                                        <img src="{{ asset('image/' . $report->image) }}" class="rounded-3 border"
                                            width="200" height="200" alt="Report Image">
                                    @endif
                                </p>

                            </div>
                            <div class="modal-footer py-0">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $reports->onEachSide(1)->links() }}


            @include('admin.contents.footer')


            @foreach ($reports as $report)
                <script type="text/javascript">
                    document.getElementById('delete-btn-{{ $report->id }}').addEventListener('click', function(ev) {
                        ev.preventDefault();

                        var urlToRedirect = ev.currentTarget.getAttribute('href');

                        swal({
                            title: "Are you sure you want to reject this report?",
                            text: "This report will not be recoverable after being rejected.",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willCancel) => {
                            if (willCancel) {
                                window.location.href = urlToRedirect;
                            }
                        });
                    });
                </script>
            @endforeach
</body>

</html>
