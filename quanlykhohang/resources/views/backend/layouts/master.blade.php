<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.head')

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('backend.layouts.menu')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include('backend.layouts.header')

            <div class="container-fluid">
                @yield('main-content')

                @include('backend.layouts.footer')
            </div>
        </div>
    </div>
    @include('backend.layouts.footerscript')
</body>

</html>
