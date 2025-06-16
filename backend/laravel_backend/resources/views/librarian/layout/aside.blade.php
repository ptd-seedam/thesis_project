        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/librarian/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Nhà sách nụ cười</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/librarian/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chức năng chính
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBorrowBooks"
                    aria-expanded="true" aria-controls="collapseBorrowBooks">
                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    <span>Quản lý mượn sách</span>
                </a>
                <div id="collapseBorrowBooks" class="collapse" aria-labelledby="headingBorrowBooks"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chức năng</h6>
                        <a class="collapse-item" href="{{ route('librarian.borrowings.index') }}">Danh sách Mượn sách</a>
                        <a class="collapse-item" href="{{ route('librarian.borrowings.create') }}">Thêm Đơn mượn sách</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFines"
                    aria-expanded="true" aria-controls="collapseFines">
                   <i class="fa fa-times" aria-hidden="true"></i>
                    <span>Quản lý phạt</span>
                </a>
                <div id="collapseFines" class="collapse" aria-labelledby="headingFines"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chức năng</h6>
                        <a class="collapse-item" href="{{ route('librarian.fines.index') }}">Danh sách Phạt</a>
                        <a class="collapse-item" href="{{ route('librarian.fines.create') }}">Thêm Đơn phạt</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
                        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooks"
                    aria-expanded="true" aria-controls="collapseBooks">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>Sách</span>
                </a>
                <div id="collapseBooks" class="collapse" aria-labelledby="headingBooks" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Chức năng</h6>
                        <a class="collapse-item" href="{{ route('librarian.books.index') }}">Danh sách Sách</a>
                        <a class="collapse-item" href="{{ route('librarian.books.create') }}">Thêm sách</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->
