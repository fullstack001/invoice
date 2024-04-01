
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
              <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                  
                </a>               
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
            
          <!-- start page title -->
          <div class="page-title-box align-self-center d-none d-md-block">
            <h4 class="page-title mb-0">@yield('page-title')</h4>
          </div>
          <!-- end page title -->
        </div>

        <div class="d-flex">    
            <div class="dropdown px-3 ">
                <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-right">
                        <div class="flex-grow-1 ms-2 text-start mt-2">
                            <span class="ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                        </div>

                        <div class="flex-shrink-0">
                            <img src="{{ auth()->user()->avatar ? URL::asset(auth()->user()->avatar) : URL::asset('assets/images/users/avatar.png') }}"
                                class="img-fluid header-profile-user rounded-circle" alt="">
                        </div>                             
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ auth()->user()->role == 'admin' ? route('admin.profile') :  route('user.profile') }}"><i
                            class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Profile</span></a>   

                     @if(auth()->user()->role == 'admin')

                        <a class="dropdown-item" href="{{ route('admin.users') }}"><i
                            class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Users</span></a> 
                                              
                        <a class="dropdown-item" href="{{ route('subscrip.index') }}">
                            <i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span
                                class="align-middle">Settings</span></a>

                     @else

                     @endif
                  
                    <a class="dropdown-item" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span
                            class="align-middle">Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>  
            
        </div>
    </div>
</header>