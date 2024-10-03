<!DOCTYPE html>
<html>

<head>
    @include('admin-2.contents.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css">
    <style>
        .spectrum {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .color-picker-container {
            width: 100%;
        }
    </style>
</head>

<body>
    @include('admin-2.contents.header')

    <div class="d-flex align-items-stretch">
        @include('admin-2.contents.sidebar')

        <div class="page-content scrollable-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Add Incident</h2>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Incident Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin-2.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Incident Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Image (Optional)</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-group">
                                <label>Choose Color (Optional)</label>
                                <div class="color-picker-container">
                                    <input type="text" id="colorPicker" name="color" class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Incident</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('admin-2.contents.footer')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>

        <script>
            $(document).ready(function() {
                $("#colorPicker").spectrum({
                    color: "#ff5733",
                    showInput: true,
                    showAlpha: true,
                    allowEmpty: true,
                    preferredFormat: "hex",
                    change: function(color) {
                        $("#colorPicker").val(color.toHexString()); // Set the input value
                    }
                });
            });
        </script>
    </div>
</body>

</html>
