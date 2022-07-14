<div class="collapse navbar-collapse mt-2" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
    <ul class="navbar-nav justify-content-end">

        <li class="nav-item d-xl-none me-2">
          <a href="javascript:;" class="btn btn-icon btn-icon-only mb-0 bg-white d-flex align-items-center" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>

        <div class="nav-item me-2">
            <a class="btn btn-icon btn-icon-only mb-0 bg-white btn-toggle-dir" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Direction Mode (LTR / RTL)') }}">
                @if ( Cookie::get('dir_mode') == 'rtl' )
                  <i class="fas fa-align-left text-primary"></i>
                @else
                  <i class="fas fa-align-right text-primary"></i>
                @endif
            </a>
        </div>

        <div class="nav-item me-2">
            <a class="btn btn-icon btn-icon-only mb-0 bg-white btn-toggle-mode" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Theme Mode (Light / Dark)') }}">
                @if ( Cookie::get('theme_mode') == 'theme-light' )
                    <i class="fas fa-moon text-warning"></i>
                @else
                    <i class="fas fa-sun text-warning"></i>
                @endif
            </a>
        </div>

        <!-- Begin:Lang Menu -->
        @php
            $mobileLangMenu = '';
        @endphp

        <li class="nav-item dropdown d-flex align-items-center">
            <a href="javascript:;" class="nav-link dropdown-toggle" id="dropdownMenuLang" data-bs-toggle="dropdown" aria-expanded="false">
                 <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-1 my-auto">
            </a>

            <ul class="dropdown-menu dropdown-menu-end px-2 mt-4" aria-labelledby="dropdownMenuLang">
                @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                    <li class="mb-2">
                      <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ localization()->getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                      </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <!-- End:Lang Menu -->

        <div class="nav-item dropdown d-md-flex px-3">
            <a class="nav-link px-0 cursor-pointer text-body" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer" aria-hidden="true"></i>
                <span class="badge bg-red"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end px-2 mt-4 text-center">
                {{ __('Script version') }}: <span class="badge bg-success">{{ Config::get('app.version') }}</span>
            </div>
        </div>

        <li class="nav-item dropdown">
            <a href="javascript:;" class="nav-link text-body" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 mt-4" aria-labelledby="dropdownMenuUser">
                <li>
                    <a href="{{ route('profile') }}" class="dropdown-item border-radius-md">
                        <i class="fas fa-user fa-fw me-2"></i>
                        {{ __('Profile') }}
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item border-radius-md">
                        <i class="fas fa-power-off fa-fw me-2"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
