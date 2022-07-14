<aside class="sidenav {{ ( Cookie::get('theme_mode') == 'theme-dark') ? '' : 'bg-white' }} navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps" id="sidenav-main">
   
    <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('home') }}">
                @if ( Cookie::get('theme_mode') === 'theme-dark' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_dark }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @elseif( Cookie::get('theme_mode') === 'theme-light' )
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @else
                    <img src="{{ \App\Models\Admin\Header::orderBy('id', 'DESC')->first()->logo_light }}" alt="{{ __( env('APP_NAME') ) }}" class="navbar-brand-image">
                @endif
            </a>
        </div>
        <hr class="horizontal dark mt-0">

        <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">

            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('posts') ? 'active' : '' }}" href="{{ route('posts') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-pencil-alt text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Posts') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('pages', 'create-page', 'authentication') ? 'active' : '' }}" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Pages') }}</span>
                    </a>

                    <div id="pages" class="multi-collapse collapse {{ Route::is('pages', 'create-page', 'authentication') ? 'show' : '' }}">

                      <ul class="nav ms-4">
                          <li class="nav-item {{ Route::is('pages') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('pages') ? 'active' : '' }}" href="{{ route('pages') }}">
                                {{ __('All Pages') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('authentication') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('authentication') ? 'active' : '' }}" href="{{ route('authentication') }}">
                                {{ __('Authentication') }}
                            </a>
                          </li>
                      </ul>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is( 'tools', 'categories') ? 'active' : '' }}" data-bs-toggle="collapse" href="#tools" role="button" aria-expanded="false" aria-controls="tools">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-settings text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Tools') }}</span>
                    </a>

                    <div id="tools" class="multi-collapse collapse {{ Route::is( 'tools', 'categories') ? 'show' : '' }}">

                      <ul class="nav ms-4">
                          <li class="nav-item {{ Route::is('tools') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('tools') ? 'active' : '' }}" href="{{ route('tools') }}">
                                {{ __('All Tools') }}
                            </a>
                          </li>
                          <li class="nav-item {{ Route::is('tools') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('categories') ? 'active' : '' }}" href="{{ route('categories') }}">
                                {{ __('Categories') }}
                            </a>
                          </li>
                      </ul>

                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'proxy', 'captcha', 'sidebar', 'gdpr', 'advertisement', 'smtp', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'active' : '' }}" data-bs-toggle="collapse" href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-cogs text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Settings') }}</span>
                    </a>

                    <div id="theme-settings" class="multi-collapse collapse {{ Route::is('general', 'menu', 'header', 'footer', 'create-footer-translations', 'edit-footer-translations', 'api-keys', 'proxy', 'captcha', 'sidebar', 'gdpr', 'advertisement', 'smtp', 'translations', 'edit-translations', 'redirects', 'advanced') ? 'show' : '' }}">
                        <ul class="nav ms-4">
                          <li class="nav-item {{ Route::is('general') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('general') ? 'active' : '' }}" href="{{ route('general') }}">
                                {{ __('General') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('header') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('header') ? 'active' : '' }}" href="{{ route('header') }}">
                                {{ __('Header') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('footer', 'create-footer-translations', 'edit-footer-translations') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('footer', 'create-footer-translations', 'edit-footer-translations') ? 'active' : '' }}" href="{{ route('footer') }}">
                                {{ __('Footer') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('menu') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('menu') ? 'active' : '' }}" href="{{ route('menu') }}">
                                {{ __('Menu') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('sidebar') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('sidebar') ? 'active' : '' }}" href="{{ route('sidebar') }}">
                                {{ __('Sidebar') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('gdpr') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('gdpr') ? 'active' : '' }}" href="{{ route('gdpr') }}">
                                {{ __('GDPR') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('advertisement') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('advertisement') ? 'active' : '' }}" href="{{ route('advertisement') }}">
                                {{ __('Advertisement') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('smtp') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('smtp') ? 'active' : '' }}" href="{{ route('smtp') }}">
                                {{ __('SMTP') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('api-keys') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('api-keys') ? 'active' : '' }}" href="{{ route('api-keys') }}">
                                {{ __('API Keys') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('proxy') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('proxy') ? 'active' : '' }}" href="{{ route('proxy') }}">
                                {{ __('Proxy') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('captcha') ? 'active' : '' }}">
                            <a class="nav-link {{ Route::is('captcha') ? 'active' : '' }}" href="{{ route('captcha') }}">
                                {{ __('Captcha') }}
                            </a>
                          </li>
                          
                          <li class="nav-item {{ Route::is('redirects') ? 'active' : '' }}">
                            <a class="nav-link {{ ( Route::is('redirects') ) ? 'active' : '' }}" href="{{ route('redirects') }}">
                                {{ __('Redirects') }}
                            </a>
                          </li>

                          <li class="nav-item {{ Route::is('translations') ? 'active' : '' }}">
                            <a class="nav-link {{ ( Route::is('translations') || Route::is('edit-translations') ) ? 'active' : '' }}" href="{{ route('translations') }}">
                                {{ __('Translations') }}
                            </a>
                          </li>
						  
                           <li class="nav-item {{ Route::is('advanced') ? 'active' : '' }}">
                            <a class="nav-link {{ ( Route::is('advanced') ) ? 'active' : '' }}" href="{{ route('advanced') }}">
                                {{ __('Advanced') }}
                            </a>
                          </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Users') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('history') ? 'active' : '' }}" href="{{ route('history') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-history text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Recent History') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('report') ? 'active' : '' }}" href="{{ route('report') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-link text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Report') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('cache') ? 'active' : '' }}" href="{{ route('cache') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-archive text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Cache') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('sitemap') ? 'active' : '' }}" href="{{ route('sitemap') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-sitemap text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Sitemap') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-info text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('About') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::is('update') ? 'active' : '' }}" href="{{ route('update') }}">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="fas fa-sync text-dark text-sm opacity-10 top-0"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ __('Update') }}</span>
                    </a>
                </li>

            </ul>

        </div>

</aside>
