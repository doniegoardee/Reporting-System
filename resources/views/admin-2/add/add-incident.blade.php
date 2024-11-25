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
                            <div class="custom-file">

                                <label class="custom-file" for="image">
                                    <i class="bi bi-upload"></i>
                                </label>
                                <input type="file" class="" id="image" name="image"
                                    accept="image/*">
                            </div>
                            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview"
                                style="display: none;">
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Spectrum CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum-colorpicker/1.8.1/spectrum.min.css" />

    <!-- Spectrum JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum-colorpicker/1.8.1/spectrum.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize the color picker
            $("#colorPicker").spectrum({
                color: "#ff5733",  // Default color
                showInput: true,
                showAlpha: true,
                allowEmpty: true,
                preferredFormat: "hex",
                change: function(color) {
                    // Update the input field with the selected color
                    $("#colorPicker").val(color.toHexString());
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
                        const newImageSrc = await removeBackground(imageSrc);
                        $('#imagePreview').attr('src', newImageSrc);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Background removal function
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
</x-app-layout>
