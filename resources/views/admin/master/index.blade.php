<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.include.headercss')
</head>

<body>
        @include('admin.include.sidebar')

        @yield('content')

      
        @include('admin.include.footer')
    </div>
    @include('admin.include.footerjs')

</body>

</html>
