<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        @if (session()->get('locale') == 'ar')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('change_locale', 'en') }}">
                    <span class="mr-1 ml-1"> {{__('english')}} </span> <img src="{{ asset('backend/img/us.png') }}" alt="EN" />
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('change_locale', 'ar') }}">
                   <span class="mr-1 ml-1">  {{__('arabic')}}</span> <img src="{{ asset('backend/img/sa.png') }}" alt="AR" />
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.settings.index') }}">
                {{ __('Backend/general.settings') }}
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <admin-notification></admin-notification>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                @if (auth()->user()->user_image != '')
                    <img class="img-profile rounded-circle" src="{{ asset('assets/users/' . auth()->user()->user_image) }}">
                @else
                    <img class="img-profile rounded-circle" src="{{ asset('assets/users/default.png') }}">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('admin.profile.index')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Backend/general.profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Backend/general.logout') }}
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
