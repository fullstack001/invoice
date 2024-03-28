<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">       

        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="logo-sm-light" height="60">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="logo-light" height="60">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn"
        id="vertical-menu-btn">
        <i class="ri-menu-2-line align-middle"></i>
    </button>

    <div data-simplebar class="vertical-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">                

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">                       
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">                       
                        <span>Invoices</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">                       
                        <span>Suppliers</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">                       
                        <span>Materials</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">                       
                        <span>Reports</span>
                    </a>
                </li>

                

            </ul>

        </div>
        <!-- Sidebar -->
    </div>

</div>
<!-- Left Sidebar End -->
