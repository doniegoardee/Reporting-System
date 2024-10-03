<!DOCTYPE html>
<html>

<head>
    @include('admin-2.contents.css')
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
                    <h2 class="h5 no-margin-bottom">Add Barangay</h2>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Barangay</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin-2.add_barangay') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Baranagay</label>
                                <input type="text" class="form-control" id="name" name="barangay" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Barangay</button>
                        </form>
                    </div>
                </div>
            </div>


            @include('admin-2.contents.footer')
        </div>
</body>

</html>
