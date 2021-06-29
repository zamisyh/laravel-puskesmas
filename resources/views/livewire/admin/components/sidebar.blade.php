<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('dash.home') }}"><img style="height: 80px" src="{{ asset('logo.png') }}" alt="Logo" srcset=""></a>
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
                    <a href="{{ route('dash.home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

               @hasanyrole('admin|apoteker|dokter')

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard-data"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item">
                            @role('admin')
                                <a href="{{ route('dash.master-data.paramedis') }}">Paramedis</a>
                                <a href="{{ route('dash.master-data.jabatan') }}">Jabatan</a>
                                <a href="{{ route('dash.master-data.bidang') }}">Bidang</a>
                                <a href="{{ route('dash.master-data.pegawai') }}">Pegawai</a>
                                <a href="{{ route('dash.master-data.dokter') }}">Dokter</a>
                                <a href="{{ route('dash.master-data.poli') }}">Poli</a>
                                <a href="{{ route('dash.master-data.jadwal-praktek-dokter') }}">Jadwal Praktek Dokter</a>
                                <a href="{{ route('dash.master-data.diagnosa') }}">Diagnosa</a>
                                <a href="{{ route('dash.master-data.tindakan') }}">Tindakan</a>
                                <a href="{{ route('dash.master-data.supplier') }}">Supplier</a>
                                <a href="{{ route('dash.master-data.operasi') }}">Operasi</a>
                                <a href="{{ route('dash.master-data.obat') }}">Obat-Obatan</a>
                                <a href="{{ route('dash.master-data.jaminan') }}">Jaminan</a>
                            @endrole
                            @role('apoteker')
                                <a href="{{ route('dash.master-data.jaminan') }}">Jaminan</a>
                                <a href="{{ route('dash.master-data.supplier') }}">Supplier</a>
                                <a href="{{ route('dash.master-data.poli') }}">Poli</a>
                                <a href="{{ route('dash.master-data.obat') }}">Obat-Obatan</a>
                            @endrole
                            @role('dokter')

                                <a href="{{ route('dash.master-data.diagnosa') }}">Diagnosa</a>
                                {{-- <a href="{{ route('dash.master-data.tindakan') }}">Tindakan</a> --}}
                            @endrole
                        </li>
                    </ul>
                </li>

               @endhasanyrole

               @hasanyrole('admin|apoteker')
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-percent"></i>
                            <span>Transaksi Obat</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('dash.transaksi.stock-obat') }}">Stock Obat</a>
                                <a href="{{ route('dash.transaksi.pengadaan-obat') }}">Pengadaan Obat</a>
                                <a href="{{ route('dash.transaksi.pengeluaran-obat') }}">Pengeluaran Obat</a>
                            </li>
                        </ul>
                    </li>
                @endhasanyrole

               @role('admin')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Management User</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('dash.management.user') }}">Users</a>
                        </li>
                    </ul>
                </li>
               @endrole
               
               @hasanyrole('admin|pendaftaran')

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-percent"></i>
                        <span>Pendaftaran</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('dash.master-data.pasien') }}">Pasien</a>
                            <a href="{{ route('dash.pendaftaran') }}">Pendaftaran</a>
                        </li>
                    </ul>
                </li>

               @endhasanyrole

               @hasanyrole('admin|laboratorium|dokter')
                <li class="sidebar-item  has-sub">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-bezier"></i>
                        <span>Tindakan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('dash.tindakan.penanganan-operasi') }}">Penanganan Operasi</a>
                            <a href="{{ route('dash.tindakan.data-berobat') }}">Data Tidakan Berobat</a>
                        </li>
                    </ul>
                </li>


                <li class="sidebar-item">
                    <a href="{{ route('dash.laboratorium') }}" class='sidebar-link'>
                        <i class="bi bi-door-open"></i>
                        <span>Laboratory</span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a href="{{ route('dash.tindakan.perbaikan-gizi') }}" class='sidebar-link'>
                        <i class="bi bi-journal-medical"></i>
                        <span>Perbaikan Gizi</span>
                    </a>
                </li>

            
               @endhasanyrole

               @hasanyrole('admin|pendaftaran')
                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-calendar3-fill"></i>
                        <span>Report</span>
                    </a>
                </li>

               @endhasanyrole


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
