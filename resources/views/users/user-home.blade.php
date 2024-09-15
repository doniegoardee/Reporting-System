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

        <!-- Sidebar Navigation end-->
        @include('users.contents.body')

        @include('users.contents.footer')


</body>

</html>
