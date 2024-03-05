<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="/admin/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link" href="/admin/penjual">
                <i class="bi bi-menu-button-wide"></i><span>Penjual</span>
            </a>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link" href="/admin/pembeli">
                <i class="bi bi-menu-button-wide"></i><span>Pembeli</span>
            </a>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link" href="/admin/warung">
                <i class="bi bi-menu-button-wide"></i><span>Warung</span>
            </a>
        </li><!-- End Components Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link" href="/admin/product">
                <i class="bi bi-menu-button-wide"></i><span>Produk</span>
            </a>
        </li><!-- End Components Nav --> --}}

        <li class="nav-item">
            <a class="nav-link" href="/admin/transaction">
                <i class="bi bi-menu-button-wide"></i><span>Transaksi</span>
            </a>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="/admin/laporan">
                        <i class="bi bi-circle-fill"></i><span>Laporan Penjualan</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/laporan/topproduct">
                        <i class="bi bi-circle-fill"></i><span>Top Produk</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href="/admin/pencairan">
                <i class="bi bi-menu-button-wide"></i><span>Pencairan</span>
            </a>
        </li><!-- End Components Nav -->
    </ul>
</aside><!-- End Sidebar-->
