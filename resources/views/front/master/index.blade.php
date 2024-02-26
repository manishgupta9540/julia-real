<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('front.master.include.headercss')
</head>

<body>
    <style>
    .toast-success{
        margin-top:10%!important;
    }
    </style>
    <div class="wrapper ovh">

        <!-- Main Header Nav -->
        @include('front.master.include.header')

        <!-- The Login Modal -->
        @yield('content')

        <!-- Our Footer -->
        
        <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
      </div>
    </div>

    @include('front.master.include.footerjs')
</body>
</html>


