<x-app-layout>
    <style>
        .spectrum {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px
        }

        .color-picker-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #colorPicker {
            width: 100%;
            /* Adjust the size to fit */
            height: 40px;
            /* Ensure it matches the design */
            border-radius: 5px;
            /* Optional for rounded corners */
            padding: 0;
            cursor: pointer;
        }

        .image-preview {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>

    <div class="container_header">
        <h5 class="fw-semibold">Add Incident</h5>
        <hr class="mt-0 text-dark" />
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Incident Added'
                });
            });
        </script>
    @endif

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title fw-bold">Incident Details</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Incident Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="agency">Corresponding Agency</label>
                                <select class="form-control" id="agency" name="agency" required>
                                    <option value="" disabled selected>Select an agency</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->agency }}"
                                            data-contact="{{ $agency->contact ?? 'N/A' }}"
                                            data-email="{{ $agency->email ?? 'N/A' }}">
                                            {{ $agency->agency }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="tel" class="form-control" id="contact" name="contact" required
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    readonly>
                            </div>
                        </div>

                    </div>

                    <div class="row ">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="image">Image <span
                                        class="text-muted">(Optional)(transparent)</span></label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*" placeholder="make sure its transparent">
                                <img id="imagePreview" class="image-preview" src="#" alt="Image Preview"
                                    style="display: none;">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label>Choose Color <span class="text-muted">(Optional)</span></label>
                                <div class="color-picker-container">
                                    <input type="color" id="colorPicker" name="color" class="form-control spectrum"
                                        value="#FA4032">
                                </div>
                            </div>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Add Incident</button>
                </form>
            </div>
        </div>
    </div>
    {{-- </div> --}}

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
    <script>
        $(document).ready(function() {
            $('#agency').on('change', function() {
                var contact = $(this).find('option:selected').data('contact');
                var email = $(this).find('option:selected').data('email');

                console.log(contact);
                console.log(email);
                $('#contact').val(contact);
                $('#email').val(email);
            });
        });
    </script>
</x-app-layout>
