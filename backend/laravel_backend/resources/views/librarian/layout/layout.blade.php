<!DOCTYPE html>
<html lang="en">

@include('librarian.layout.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('librarian.layout.aside')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('librarian.layout.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
                @include('librarian.layout.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('librarian.layout.js')

</body>

</html>
