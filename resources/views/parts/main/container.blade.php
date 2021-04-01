            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                @if(Request::segment(1) == "dashboard")
                                <li class="{{ Request::is('dashboard') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/dashboard">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "data")
                                <li class="{{ Request::is('data') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/data">
                                        <span class="pcoded-micon"><i class="feather icon-server"></i></span>
                                        <span class="pcoded-mtext">Data Training</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "pengujian")
                                <li class="{{ Request::is('pengujian') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/pengujian">
                                        <span class="pcoded-micon"><i class="feather icon-sliders"></i></span>
                                        <span class="pcoded-mtext">Pengujian</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>