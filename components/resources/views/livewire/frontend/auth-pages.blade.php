  <div class="page">
    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

    <main class="main">

        @if(Auth::user() && Auth::user()->email_verified_at == null)
            <div class="alert alert-warning mb-0 text-center text-white rounded-0 z-index-1" role="alert">
              {{ __('Your email address is not verified.') }} <a href="{{ route('verify-email') }}" class="alert-link text-white text-decoration-underline">{{ __('Verify it here!') }}</a>
            </div>
        @endif

        @switch(true)

            @case( Route::is('login') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Login')->first()->status == true )
                        @livewire('frontend.auth-pages.login')
                    @else
                        @include('errors.disabled', ['message' => 'Login'])
                    @endif
                @break

            @case( Route::is('admin-login') )
                    @livewire('frontend.auth-pages.login')
                @break

            @case( Route::is('register') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Register')->first()->status == true )
                        @livewire('frontend.auth-pages.register')
                    @else
                        @include('errors.disabled', ['message' => 'Register'])
                    @endif
                @break

            @case( Route::is('forgot-password') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Forgot Password')->first()->status == true )
                        @livewire('frontend.auth-pages.forgot-password')
                    @else
                        @include('errors.disabled', ['message' => 'Forgot Password'])
                    @endif
                @break

            @case( Route::is('password.reset') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Reset Password')->first()->status == true )
                        @livewire('frontend.auth-pages.reset-password', [
                                  'token' => request()->token,
                                  'email' => request()->email
                                ])
                    @else
                        @include('errors.disabled', ['message' => 'Reset Password'])
                    @endif
                @break

            @case( Route::is('verify-email') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Verify Email')->first()->status == true )
                        @livewire('frontend.auth-pages.verify-email')
                    @else
                        @include('errors.disabled', ['message' => 'Verify Email'])
                    @endif
                @break

            @case( Route::is('user-profile') )
                    @if ( \App\Models\Admin\AuthPages::where('name', 'Profile')->first()->status == true )
                        @livewire('frontend.auth-pages.profile')
                    @else
                        @include('errors.disabled', ['message' => 'Profile'])
                    @endif
                @break

            @default
                
        @endswitch
        
    </main>

    <x-frontend.footer :footer="$footer" :general="$general" :socials="$socials" />

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/main.min.js') }}"></script>

    @if ( $captcha->status == true && !empty($captcha->site_key ) && !empty($captcha->secret_key ) )
      <script src="https://www.google.com/recaptcha/api.js?render={{ $captcha->site_key }}"></script>
    @endif

    @if ( $general->back_to_top == true )
        <!-- Scroll back to top -->
        <div id="backtotop"> 
            <a href="javascript:void(0)" class="backtotop"></a> 
        </div>

        <script type="text/javascript"> 
            jQuery(document).ready(function ($) {
                $("#backtotop").hide(); 
                $(window).scroll(function () { 
                    if ($(this).scrollTop() > 500) { 
                        $('#backtotop').fadeIn(); 
                    } else { 
                        $('#backtotop').fadeOut(); 
                    } 
                });   
            });

            jQuery('.backtotop').click(function () { 
                jQuery('html, body').animate({ 
                    scrollTop: 0 
                }, 'slow'); 
            });
        </script> 
        <!-- End of Scroll back to top -->
    @endif

    @if (Cookie::get('cookies') == null)

      @if ( $notice->status == true )

              <div class="row cookies-wrapper alert {{ $notice->background }}" role="alert">
                <div class="col-md-12 col-lg-{{ ($notice->button == true) ? '10' : '12'}} my-auto {{ $notice->align }}">
                  {!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}
                </div>

                @if ( $notice->button == true)
                  <div class="col-md-12 col-lg-2 my-auto text-end p-2">
                      <button id="acceptCookies" target="_blank" class="btn btn-sm bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                  </div>
                @endif
                <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
              </div>

          <script>
             (function( $ ) {
                "use strict";

                    jQuery("#acceptCookies").click(function(){
                        jQuery.ajax({
                            type : 'get',
                            url : '{{ url('/') }}/cookies/accept',
                            success: function(e) {
                                jQuery('.cookies-wrapper').remove();
                            }
                        });
                    });

            })( jQuery );
          </script>
      @endif

    @endif

    @if ( $general->dir_mode == true )
      <script>
         (function( $ ) {
            "use strict";

                jQuery(".btn-toggle-dir").click(function(){
                    jQuery.ajax({
                        type : 'get',
                        url : '{{ url('/') }}/dir/mode',
                        success: function(e) {
                            window.location.reload();
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif
        
    @if ( $general->theme_mode == true )
      <script>
         (function( $ ) {
            "use strict";

                jQuery(".btn-toggle-mode").click(function(){
                    jQuery.ajax({
                        type : 'get',
                        url : '{{ url('/') }}/theme/mode',
                        success: function(e) {
                            window.location.reload();
                        }
                    });
                });

        })( jQuery );
      </script>
    @endif

    @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
      {!! $advanced->insert_footer !!}
    @endif

  </div>