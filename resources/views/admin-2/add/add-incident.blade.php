<x-app-layout>
    <style>
        .spectrum {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .color-picker-container {
            width: 100%;
        }

        .image-preview {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>

    <div class="page-content scrollable-content bg-light">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Add Incident</h2>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Incident Details</h4>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin-2.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Incident Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image (Optional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview" style="display: none;">
                        </div>

                        <div class="form-group">
                            <label>Choose Color (Optional)</label>
                            <div class="color-picker-container">
                                <input type="color" id="colorPicker" name="color" class="form-control spectrum">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Incident</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum-colorpicker/1.8.1/spectrum.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#colorPicker").spectrum({
                color: "#ff5733",
                showInput: true,
                showAlpha: true,
                allowEmpty: true,
                preferredFormat: "hex",
                change: function(color) {
                    $("#colorPicker").val(color.toHexString());
                }
            });

            $('#image').change(function() {
                const input = this;
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
</x-app-layout>
