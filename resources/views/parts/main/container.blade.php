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
                                        <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "data-training")
                                <li class="{{ Request::is('data-training') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/data-training">
                                        <span class="pcoded-micon"><i class="feather icon-folder"></i></span>
                                        <span class="pcoded-mtext">Data Training</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "data-testing")
                                <li class="{{ Request::is('data-testing') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/data-testing">
                                        <span class="pcoded-micon"><i class="feather icon-server"></i></span>
                                        <span class="pcoded-mtext">Data Testing</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "pengujian")
                                <li class="{{ Request::is('pengujian') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/pengujian">
                                        <span class="pcoded-micon"><i class="feather icon-cpu"></i></span>
                                        <span class="pcoded-mtext">Pengujian</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "analisis")
                                <li class="{{ Request::is('pengujian') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/analisis">
                                        <span class="pcoded-micon"><i class="feather icon-search"></i></span>
                                        <span class="pcoded-mtext">Analisis</span>
                                    </a>
                                </li>
                                @if (Request::segment(1) == "kontrol")
                                <li class="{{ Request::is('kontrol') ? 'active' : 'active' }}">
                                    @else
                                <li class="">
                                    @endif
                                    <a href="/kontrol">
                                        <span class="pcoded-micon"><i class="feather icon-thermometer"></i></span>
                                        <span class="pcoded-mtext">Kontrol</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>