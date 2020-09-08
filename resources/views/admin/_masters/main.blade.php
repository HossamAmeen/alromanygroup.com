<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    @include('admin._masters.header')
    @yield('header')
</head>
<body class="">
@include('admin._masters.nav')
<section id="main-container">
    @include('admin._masters.side-nav')

            <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
            @yield('content')
            <!--Top breadcrumb start -->
                    </div>
                </div>

                <!-- Main Content Element  End-->

            </div>
        </div>
    </section>

    <!--Page main section end -->
    @include('admin._masters.hidden')
</section>
@include('admin._masters.footer')
@yield('footer')
</body>
</html>