<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>main">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Semi Joyo</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url() ?>main">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MENU
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-store"></i>
            <span>Penjualan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Penjualan</h6>
                <a class="collapse-item" href="<?= base_url() ?>transaksi/tambah">Menu Kasir</a>
                <a class="collapse-item" href="<?= base_url() ?>transaksi">Transaksi Penjualan</a>
                <a class="collapse-item" href="<?= base_url() ?>stokpenjualan">Data Stok Barang Jual</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-pen-square"></i>
            <span>Barang</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manajemen Barang</h6>
                <a class="collapse-item" href="<?= base_url() ?>barang">Restock Barang</a>
                <a class="collapse-item" href="<?= base_url() ?>distributor">Distributor Barang</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>hutang">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Utang Piutang</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>utils/database">
            <i class="fas fa-fw fa-database"></i>
            <span>Database</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>