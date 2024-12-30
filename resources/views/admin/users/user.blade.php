<x-app-layout>
    <style>
        #suggestions {
            position: absolute;
            z-index: 1000;
            background: white;
            border: 1px solid #ccc;
            display: none;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f0f0f0;

        }
    </style>
    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">User List</h2>
                <hr class="mt-0 bg-black">
            </div>
        </div>

        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-gradient-light text-center">
                    <h4 class="mb-0">Users</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <form action="{{ route('admin.user') }}" method="GET" class="mb-4">
                                <div class="input-group position-relative">
                                    <input type="text" name="query" id="user-search" class="form-control"
                                        placeholder="Search by name or email" autocomplete="off"
                                        value="{{ request('query') }}">
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i>
                                        Search</button>
                                </div>
                                <div id="suggestions" class="position-absolute"></div>
                            </form>
                        </div>
                    </div>
                    <hr class="mt-0 bg-black">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#user-search').on('keyup', function() {
                        var query = $(this).val();

                        if (query.length > 1) {
                            $.ajax({
                                url: "{{ route('admin.user') }}",
                                method: "GET",
                                data: {
                                    query: query
                                },
                                success: function(data) {
                                    $('#suggestions').html(data.html).show();
                                }
                            });
                        } else {
                            $('#suggestions').hide();
                        }
                    });

                    $(document).on('click', '.suggestion', function() {
                        $('#user-search').val($(this).text());
                        $('#suggestions').hide();
                    });
                });
            </script>

        </div>



</x-app-layout>
