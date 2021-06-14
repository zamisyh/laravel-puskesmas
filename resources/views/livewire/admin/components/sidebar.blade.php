<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard-data"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item">
                            <a href="{{ route('dash.master-data.paramedis') }}">Paramedis</a>
                            <a href="{{ route('dash.master-data.jabatan') }}">Jabatan</a>
                            <a href="{{ route('dash.master-data.bidang') }}">Bidang</a>
                            <a href="{{ route('dash.master-data.pegawai') }}">Pegawai</a>
                            <a href="{{ route('dash.master-data.poli') }}">Poli</a>
                            <a href="component-alert.html">Dokter</a>
                            <a href="component-alert.html">Jadwal Praktek Dokter</a>
                            <a href="component-alert.html">Pasien</a>
                            <a href="component-alert.html">Diagnosa</a>
                            <a href="component-alert.html">Tindakan</a>
                            <a href="component-alert.html">Supplier</a>
                            <a href="component-alert.html">Operasi</a>
                            <a href="component-alert.html">Obat-Obatan</a>
                            <a href="component-alert.html">Jaminan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-percent"></i>
                        <span>Transaksi Obat</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="component-alert.html">Stock Obat</a>
                            <a href="component-alert.html">Pengadaan Obat</a>
                            <a href="component-alert.html">Pengeluaran Obat</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Management User</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('dash.management.role') }}">Roles</a>
                            <a href="#">Permission</a>
                            <a href="{{ route('dash.management.user') }}">Users</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Registration</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-bezier"></i>
                        <span>Tindakan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="component-alert.html">Penanganan Operasi</a>
                            <a href="component-alert.html">Data Poli Kia</a>
                            <a href="component-alert.html">Data Perbaikan Gizi</a>
                            <a href="component-alert.html">Data Tidakan Berobat</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-door-open"></i>
                        <span>Laboratory</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-calendar3-fill"></i>
                        <span>Report</span>
                    </a>
                </li>



            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
