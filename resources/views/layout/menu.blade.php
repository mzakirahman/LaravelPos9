@if(Auth::user()->level  == 1)
<li class="nav-item">
    <a href="{{ url('dashboard')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
             Beranda
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('users')}}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
             User
        </p>
    </a>
</li>

<li class="nav-header">PEMESANAN</li>
<li class="nav-item">
    <a href="{{ url('surats')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
             Surat Pemesanan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('pesanans')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
             Surat Balasan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('penyerahans')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
            Penyerahan Pemesanan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('konfirmasis/create')}}" class="nav-link">
        <i class="nav-icon fas fa-tree"></i>
        <p>
            Konfirmasi
        </p>
    </a>
</li>
<li class="nav-header">DATA MASTER</li>
<li class="nav-item">
    <a href="{{ url('infotorial')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Media Online
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('harians')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Cetak Harian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('mingguans')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Cetak Mingguan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('radios')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Radio
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('tvs')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Tv
        </p>
    </a>
</li>
<li class="nav-header">REPORT</li>
<li class="nav-item">
    <a href="{{ url('report/form')}}" class="nav-link">
        <i class="nav-icon fas fa-print"></i>
        <p>
             Rekapan
        </p>
    </a>
</li>

@elseif(Auth::user()->level == 2)
<li class="nav-item">
    <a href="{{ url('home')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
             Beranda
        </p>
    </a>
</li>

<li class="nav-header">PEMESANAN</li>
<li class="nav-item">
    <a href="{{ url('wartawan/surats/aad')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
             Surat Pemesanan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('pesanans/create')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
             Surat Balasan 
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('penyerahans/create')}}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
            Penyerahan Pemesanan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('konfirmasis/wartawan')}}" class="nav-link">
        <i class="nav-icon fas fa-tree"></i>
        <p>
            Jadwal Konfirmasi
        </p>
    </a>
</li>
@if(Auth::check() && Auth::user()->username == 'riau pos')
    <li class="nav-item">
        <a href="{{ url('wartawan/harians/index')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif

@if(Auth::check() && Auth::user()->username == 'riau lantang')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif

@if(Auth::check() && Auth::user()->username == 'riau eksis')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Go Riau.com')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Dumai Pos')
    <li class="nav-item">
        <a href="{{ url('wartawan/harians/index')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Haluan Riau')
    <li class="nav-item">
        <a href="{{ url('wartawan/mingguans/ad')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Dumai News')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Lintas Media')
    <li class="nav-item">
        <a href="{{ url('wartawan/mingguans/ad')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Radio patra')
    <li class="nav-item">
        <a href="{{ url('wartawan/radios/aa')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Rtv')
    <li class="nav-item">
        <a href="{{ url('wartawan/tvs/ab')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Utusan Riau')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Harian Vokal')
    <li class="nav-item">
        <a href="{{ url('wartawan/harians/index')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'TribunNews')
    <li class="nav-item">
        <a href="{{ url('wartawan/mingguans/ad')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif
@if(Auth::check() && Auth::user()->username == 'Liputan Oke')
    <li class="nav-item">
        <a href="{{ url('wartawan/infotorials/addd')}}" class="nav-link">
            <i class="nav-icon fas fa-print"></i>
            <p>
                Bukti Pembayaran
            </p>
        </a>
    </li>
@endif

@elseif(Auth::user()->level == 3)
<li class="nav-item">
    <a href="{{ url('dashboard')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
             Beranda
        </p>
    </a>
</li>

<li class="nav-header">DATA MASTER</li>
<li class="nav-item">
    <a href="{{ url('infotorials/add')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Media Online
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('harians/add')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Cetak Harian
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('mingguans/add')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Cetak Mingguan
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('radios/add')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Radio
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('tvs/add')}}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>
             Tv
        </p>
    </a>
<li class="nav-header">REPORT</li>
<li class="nav-item">
    <a href="{{ url('report/form')}}" class="nav-link">
        <i class="nav-icon fas fa-print"></i>
        <p>
             Rekapan
        </p>
    </a>
</li>
@endif