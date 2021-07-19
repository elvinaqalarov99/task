<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'AdminPanel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void()" class="d-block">{{ Auth::user()->email }}</a>
          <a href="{{ route('logout') }}" class="d-block" role="button"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            {{ __('default.logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href=" {{ route('dashboard') }}" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('default.dashboard') }}
              </p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('dashboard/companies*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('dashboard/companies*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                {{ __('companies.title') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('companies.index') }}" class="nav-link {{ (request()->is('dashboard/companies')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('companies.title') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('companies.create') }}" class="nav-link {{ (request()->is('dashboard/companies/create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('companies.create') }}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ (request()->is('dashboard/employees*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('dashboard/employees*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                {{ __('employees.title') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link {{ (request()->is('dashboard/employees')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('employees.title') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employees.create') }}" class="nav-link {{ (request()->is('dashboard/employees/create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('employees.create') }}</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>