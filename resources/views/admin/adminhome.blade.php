<!DOCTYPE html>
<html>

<head>

    @include('admin.contents.css')

</head>

<body>

    @include('admin.contents.header')


    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->

        <!-- Sidebar Header-->

        @include('admin.contents.sidebar')


        <!-- Sidebar Navigation end-->

        @include('admin.contents.body')

        @include('admin.contents.footer')

</body>

</html>
