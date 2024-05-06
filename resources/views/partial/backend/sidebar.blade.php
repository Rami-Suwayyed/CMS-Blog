@php
    $current_page = Route::currentRouteName();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('backend/img/logo.png') }}" width="50" alt="{{ config('app.name') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item @if(request()->routeIs("admin.index")) active @endif">
        <a href="{{ route('admin.index') }}" class="nav-link ">
            <i class="fa fa-home"></i>
            <span>{{__('main')}}</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Nav Item - Posts Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.posts.*") || request()->routeIs("admin.post_comments.*") || request()->routeIs("admin.post_categories.*") || request()->routeIs("admin.post_categories.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-newspaper"></i>
            <span>{{__('posts')}}</span>
        </a>
        <div id="collapseTwo" class="collapse @if(request()->routeIs("admin.posts.*") || request()->routeIs("admin.post_comments.*") || request()->routeIs("admin.post_categories.*") || request()->routeIs("admin.post_categories.*")) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.posts.*") ) active @endif" href="{{route('admin.posts.index')}}">{{__('posts')}}</a>
                <a class="collapse-item @if(request()->routeIs("admin.post_comments.*") ) active @endif" href="{{route('admin.post_comments.index')}}">{{__('comments')}}</a>
                <a class="collapse-item @if(request()->routeIs("admin.post_categories.*") ) active @endif" href="{{route('admin.post_categories.index')}}">{{__('categories')}}</a>
                <a class="collapse-item @if(request()->routeIs("admin.post_tags.*") ) active @endif" href="{{route('admin.post_tags.index')}}">{{__('tags')}}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.pages.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-file"></i>
            <span>{{__('pages')}}</span>
        </a>
        <div id="collapsePages" class="collapse @if(request()->routeIs("admin.pages.*")) show @endif" aria-labelledby="headingPages"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.pages.*")) active @endif" href="{{route('admin.pages.index')}}">{{__('pages')}}</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.users.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
           aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-user"></i>
            <span>{{__('users')}}</span>
        </a>
        <div id="collapseUsers" class="collapse  @if(request()->routeIs("admin.users.*")) show @endif " aria-labelledby="headingUsers"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.users.*")) active @endif " href="{{route('admin.users.index')}}">{{__('users')}}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Roles Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.roles.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
           aria-expanded="true" aria-controls="collapseRoles">
            <i class="fas fa-scroll"></i>
            <span>{{__('roles')}}</span>
        </a>
        <div id="collapseRoles" class="collapse  @if(request()->routeIs("admin.roles.*")) show @endif " aria-labelledby="headingRoles"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.roles.*")) active @endif " href="{{route('admin.roles.index')}}">{{__('roles')}}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Permissions Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.permissions.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermissions"
           aria-expanded="true" aria-controls="collapsePermissions">
            <i class="fas fa-pencil-ruler"></i>
            <span>{{__('permissions')}}</span>
        </a>
        <div id="collapsePermissions" class="collapse  @if(request()->routeIs("admin.permissions.*")) show @endif " aria-labelledby="headingPermissions"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.permissions.*")) active @endif " href="{{route('admin.permissions.index')}}">{{__('permissions')}}</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Supervisors Collapse Menu -->
    <li class="nav-item @if(request()->routeIs("admin.supervisors.*")) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupervisors"
           aria-expanded="true" aria-controls="collapseSupervisors">
            <i class="fas fa-users-cog"></i>
            <span>{{__('supervisors')}}</span>
        </a>
        <div id="collapseSupervisors" class="collapse  @if(request()->routeIs("admin.supervisors.*")) show @endif " aria-labelledby="headingSupervisors"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(request()->routeIs("admin.supervisors.*")) active @endif " href="{{route('admin.supervisors.index')}}">{{__('supervisors')}}</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
