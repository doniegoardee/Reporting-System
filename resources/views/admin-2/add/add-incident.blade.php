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

        .image-preview {
            max-width: 100%;
            margin-top: 10px;
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
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image"
                                        accept="image/*">
                                    <label class="custom-file-label" for="image">
                                        <i class="bi bi-upload"></i> Choose file
                                    </label>
                                </div>
                                <img id="imagePreview" class="image-preview" src="#" alt="Image Preview"
                                    style="display: none;">
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
                // Color Picker Initialization
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

                // Handle image upload and background removal
                const input = document.getElementById('image');
                input.addEventListener('change', async function() {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const reader = new FileReader();

                        reader.onload = async function(e) {
                            const imageSrc = e.target.result;
                            $('#imagePreview').attr('src', imageSrc).show();

                            // Call the background removal function
                            const newImageSrc = await removeBackground(imageSrc);
                            $('#imagePreview').attr('src', newImageSrc);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Background removal function using remove.bg API
                async function removeBackground(imageData) {
                    const apiKey = 'YOUR_API_KEY'; // Replace with your actual API key
                    const response = await fetch('https://api.remove.bg/v1.0/removebg', {
                        method: 'POST',
                        headers: {
                            'X-Api-Key': apiKey,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            image_file_b64: imageData.split(',')[1],
                            size: 'auto',
                        }),
                    });

                    if (response.ok) {
                        const blob = await response.blob();
                        return URL.createObjectURL(blob); // Return the URL of the new image
                    } else {
                        console.error('Error removing background:', response);
                        return imageData; // Return original if there's an error
                    }
                }
            });
        </script>
    </div>
</body>

</html>
