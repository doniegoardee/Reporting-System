<x-app-layout>


    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="card container my-5 p-4" style="max-width: 900px;">
        <h1 class="text-center mb-4">Create Seminar</h1>

        <form action="{{ route('admin.seminar-store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter seminar title" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter seminar description"></textarea>
            </div>

            <!-- Date -->
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter seminar location" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg w-100">Create Seminar</button>
            </div>
        </form>
    </div>

</x-app-layout>
