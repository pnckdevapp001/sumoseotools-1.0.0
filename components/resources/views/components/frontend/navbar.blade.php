<!-- Navbar Light -->
<nav class="navbar navbar-expand-lg {{ ( Cookie::get('theme_mode') == 'theme-light') ? 'navbar-light bg-white' : '' }} z-index-3 @if ($header->sticky_header) position-sticky z-index-sticky top-0 @endif">
  <div class="container">
    <a class="navbar-brand logo-image" title="{{ __($homeTitle) }}" href="{{ route('home') }}">
        @if ( !empty($header->logo_light) )

            @if ( Cookie::get('theme_mode') === 'theme-dark' )
                <img src="{{ $header->logo_dark }}" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
            @elseif( Cookie::get('theme_mode') === 'theme-light' )
                <img src="{{ $header->logo_light }}" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
            @else
                <img src="{{ $header->logo_light }}" alt="{{ __($homeTitle) }}" class="navbar-brand-image">
            @endif
            
        @else
          {{ $homeTitle }}
        @endif
    </a>

    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>

    <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
      
        <ul class="navbar-nav navbar-nav-hover mx-auto">

            <!-- Begin::Navbar Left -->
            @foreach($menus as $key => $value)

                @if ( $value['type'] == 'link' )

                  @if( count($value['children']) )
                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="#navbarDropdownMenuChild" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} me-2"></i>
                               @endif
                               {{ __($value['text']) }}

                                @if( Cookie::get('theme_mode') === 'theme-light' )
                                    <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1" />
                                @else
                                    <img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow ms-1" />
                                @endif
                               
                            </a>

                            <x-frontend.menu :childs="$value['children']" />
                        </li>

                  @else

                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} me-2"></i>
                           @endif
                          {{ __($value['text']) }}
                        </a>
                    </li>

                  @endif

                @endif

            @endforeach
            <!-- End::Navbar Left -->

            <!-- Begin:Lang Menu -->
            @if ( $general->language_switcher == true )

              @php
                $mobileLangMenu = '';
              @endphp

                <li class="nav-item dropdown mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-2 my-auto"> 
                        {{ localization()->getCurrentLocaleNative() }}
                            @if( Cookie::get('theme_mode') === 'theme-light' )
                                <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1" />
                            @else
                                <img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow ms-1" />
                            @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation px-2 mt-md-0 mt-lg-4">
                       @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                          <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $properties->key() }}" href="{{ url('/') . '/' .  $properties->key() }}">
                            <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-2 my-auto"> {{ $properties->native() }}
                          </a>
                       @endforeach
                    </div>
                </li>
              
            @endif
            <!-- End:Lang Menu -->
        </ul>

        <ul class="navbar-nav navbar-nav-hover">

            @if ( $general->dir_mode == true )
                <li class="nav-item mx-2 mx-lg-auto my-2 my-lg-auto">
                    <a class="btn btn-icon btn-icon-only mb-0 me-2 bg-white btn-toggle-dir" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Direction Mode (LTR / RTL)') }}">
                        @if ( Cookie::get('dir_mode') == 'rtl' )
                          <i class="fas fa-align-left text-primary"></i>
                        @else
                          <i class="fas fa-align-right text-primary"></i>
                        @endif
                    </a>
                </li>
            @endif

            @if ( $general->theme_mode == true )
                <li class="nav-item mx-2 mx-lg-auto my-2 my-lg-auto">
                    <a class="btn btn-icon btn-icon-only mb-0 me-2 bg-white btn-toggle-mode" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Theme Mode (Light / Dark)') }}">
                        @if ( Cookie::get('theme_mode') == 'theme-light' )
                            <i class="fas fa-moon text-warning"></i>
                        @else
                            <i class="fas fa-sun text-warning"></i>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Begin::Navbar Right -->
            @foreach($menus as $key => $value)

                @if ( $value['type'] == 'button' )

                  @if( count($value['children']) )
                        <li class="nav-item dropdown">
                            <a class="btn btn-icon dropdown-toggle me-2 {{ $value['class'] }}" href="#navbarDropdownMenuButton{{ $key }}" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                               @if ( !empty($value['icon']) )
                                 <i class="{{ $value['icon'] }} icon"></i>
                               @endif
                               {{ __($value['text']) }}
                            </a>

                            <x-frontend.menu :childs="$value['children']" />
                        </li>

                  @else

                    <li class="nav-item mx-2 mx-lg-auto my-2 my-lg-auto">
                        <a class="btn btn-icon mb-0 me-2 {{ $value['class'] }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} icon"></i>
                           @endif
                          {{ __($value['text']) }}
                        </a>
                    </li>

                  @endif

              @endif

            @endforeach
            <!-- End::Navbar Right -->

            <!-- Begin::Login -->
            @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status == true)
            
                @if ( Auth::user() )

                    <li class="dropdown mx-2 mx-lg-auto my-2 my-lg-auto">
                      <div class="author align-items-center cursor-pointer" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}?s=150&d=mm&r=g" class="avatar shadow">
                          <div class="name ps-2">
                              <span>{{ Auth::user()->fullname }}</span>
                              <div class="stats">
                                  <small>{{ ( Auth::user()->is_admin == 1) ? __('Administrator') : __('Member') }}</small>
                              </div>
                          </div>
                      </div>

                      <ul class="dropdown-menu dropdown-menu-animation px-2 mt-md-0 mt-lg-4" aria-labelledby="dropdownMenuUser">
                            @if ( Auth::user()->is_admin == 1 )
                                <li>
                                    <a href="{{ route('dashboard') }}" class="dropdown-item border-radius-md">
                                        <i class="fas fa-tachometer-alt fa-fw me-2"></i>
                                        {{ __('Admin Dashboard') }}
                                    </a>
                                </li>
                            @endif

                            @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status == true )
                                <li>
                                    <a href="{{ route('user-profile') }}" class="dropdown-item border-radius-md">
                                        <i class="fas fa-user fa-fw me-2"></i>
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('user-logout') }}" class="dropdown-item border-radius-md">
                                    <i class="fas fa-power-off fa-fw me-2"></i>
                                    {{ __('Logout') }}
                                </a>
                            </li>
                      </ul>
                    </li>

                @else
                    <li class="nav-item mx-2 mx-lg-auto my-2 my-lg-auto">
                        <a class="btn mb-0 me-2 btn-primary bg-gradient-success" href="{{ route('login')}}">
                            <i class="fas fa-user fa-fw"></i>
                            {{ __('Login') }}
                        </a>
                    </li>
                @endif

            @endif
            <!-- End::Login -->
        </ul>

    </div>
  </div>
</nav>
<!-- End Navbar -->