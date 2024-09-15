<!DOCTYPE html>
<html>

<head>

    @include('users.contents.css')

</head>

<body>

    @include('users.contents.header')


    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('users.contents.sidebar')

        <div class="page-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h1>Create New Report</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="issue">Incident/Disaster Type</label>
                                    <select class="form-select" name="issue" id="" required>
                                        <option class="dropdown-item" value="">Select Incident Type</option>
                                        <option class="dropdown-item" value="flood">Flood</option>
                                        <option class="dropdown-item" value="typhoon">Typhoon</option>
                                        <option class="dropdown-item" value="earthquake">Earthquake</option>
                                        <option class="dropdown-item" value="fire">Fire</option>
                                        <option class="dropdown-item" value="medical">Medical Emergency</option>
                                        <option class="dropdown-item" value="infrastructure">Infrastructure Damage
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <select class="form-select" name="location" id="" required>
                                        <option class="dropdown-item" value="Centro">Centro</option>
                                        <option class="dropdown-item" value="Centro West">Centro West</option>
                                        <option class="dropdown-item" value="Cabaritan">Cabaritan</option>
                                        <option class="dropdown-item" value="Santa Maria">Santa Maria</option>
                                        <option class="dropdown-item" value="Leron">Leron</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="severity">Severity</label>
                                    <select class="form-select" name="severity" id="" required>
                                        <option class="dropdown-item" value="low">Low</option>
                                        <option class="dropdown-item" value="medium">Medium</option>
                                        <option class="dropdown-item" value="high">High</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="affected_people">Number of People Affected</label>
                                    <input type="number" class="form-control" id="affected_people" name="num_affected"
                                        min="0">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea class="form-control" name="details" id="details" cols="30" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="urgent_needs">Urgent Needs</label>
                                <textarea class="form-control" id="urgent_needs" name="needs" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Navigation end-->

            @include('users.contents.footer')


</body>

</html>
