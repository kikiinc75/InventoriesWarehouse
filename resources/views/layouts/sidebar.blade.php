<div class="default-sidebar">
    <!-- Begin Side Navbar -->
    <nav class="side-navbar box-scroll sidebar-scroll">
        <!-- Begin Main Navigation -->
        <ul class="list-unstyled">
            <li class="@yield('nav-dashboard','')"><a href="/"><i class="ti ti-dashboard"></i><span>Dashboard</span></a></li>
        </ul>
        @if(Auth::user()->id_level=='1')
        <span class="heading">Master User</span>
        <ul class="list-unstyled">
            <li class="@yield('nav-user','')"><a href="{{route('user.index')}}"><i class="la la-user-secret"></i><span>User</span></a></li>
            <li class="@yield('nav-level','')"><a href="{{ route('level.index')}}"><i class="la la-cog"></i><span>Level</span></a></li>
        </ul>
        <span class="heading">Master Data</span>
        <ul class="list-unstyled">
            <li class="@yield('nav-kota','')"><a href="{{route('kota.index')}}"><i class="la la-map-marker"></i><span>Kota</span></a></li>
            <li class="@yield('nav-supplier','')"><a href="{{route('supplier.index')}}"><i class="la la-truck"></i><span>Supplier</span></a></li>
            <li class="@yield('nav-kategori','')"><a href="{{route('kategori.index')}}"><i class="la la-tasks"></i><span>Kategori</span></a></li>
            <li class="@yield('nav-ruang','')"><a href="{{route('ruang.index')}}"><i class="la la-building"></i><span>Ruang</span></a></li>
        </ul>
        @endif
        <span class="heading">Master Barang</span>
        <ul class="list-unstyled">
            <li class="@yield('nav-inventaris','')"><a href="{{route('inventaris.index')}}"><i class="la la-archive"></i><span>Inventaris</span></a></li>
            @if(Auth::user()->id_level!='3')
            <li class="@yield('nav-masuk','')"><a href="{{route('masuk.index')}}"><i class="la la-plus-square"></i><span>Inventaris Masuk</span></a></li>
            <li class="@yield('nav-keluar','')"><a href="{{route('keluar.index')}}"><i class="la la-minus-square"></i><span>Inventaris Keluar</span></a></li>
            @endif
            <li class="@yield('nav-pinjam','')"><a href="{{route('pinjam.index')}}"><i class="la la-list-alt"></i><span>Peminjaman</span></a></li>
        </ul>
        <!-- End Main Navigation -->
    </nav>
    <!-- End Side Navbar -->
</div>