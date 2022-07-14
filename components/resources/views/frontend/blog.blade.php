@php
  $dir_mode = ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir_mode }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Blog') }} - {{ $homeTitle }}</title>

        <link rel="shortcut icon" href="{{ $header->favicon }}"/>

        <meta name="description" content="{{ __('Get all the latest news on updates, support issues and tutorials.') }}" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="{{ localization()->getCurrentLocaleRegional() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ __('Blog') }}">
        <meta property="og:description" content="{{ __('Get all the latest news on updates, support issues and tutorials.') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ __('Blog') }}">
        <meta property="og:updated_time" content="@php 

          echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', ''.$page->updated_at.'' )->toIso8601String();

        @endphp">

        @if ( !empty($page->featured_image) )
<meta property="og:image" content="{{ $page->featured_image }}">
        <meta property="og:image:secure_url" content="{{ $page->featured_image }}">
        <meta property="og:image:width" content="{{ Image::make($page->featured_image)->width() }}">
        <meta property="og:image:height" content="{{ Image::make($page->featured_image)->height() }}">
        <meta property="og:image:alt" content="{{ __('Blog') }}">
        <meta property="og:image:type" content="{{ File::extension($page->featured_image) }}">
        @endif

        @php
        if ( !empty($twitter['url']) ) {

          $pregCheck = preg_match('/(?:https?:\/\/)?(?:mobile\.)?(?:www\.)?(?:twitter.com\/)(?:[@])?([A-Za-z0-9-_\.]+)(?:\/status\/(?:[a-z0-9]{0,}))?(?:\?.(?:\=.)?(?:\&.)?)?/', $twitter['url'], $match);

          if ( $pregCheck ){
            echo '<meta name="twitter:title" content="'.__('Blog').'">
        <meta name="twitter:description" content="'.__('Get all the latest news on updates, support issues and tutorials.').'">
        <meta name="twitter:site" content="@'.$match[1].'">
        <meta name="twitter:creator" content="@'.$match[1].'">';
          }

        }
        @endphp

        @if ( !empty($page->featured_image) )
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $page->featured_image }}">
        @endif

    @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
    <link rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}" />
    @endforeach

        @if ( $general->page_load == true )

        <!-- Pace -->
        <script src="{{ asset('assets/js/pace.min.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('assets/css/pace-theme-default.min.css') }}">

        @endif

        @if ( $general->adblock_detection == true )
          <!-- Aweet Alert 2 -->
          <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
        @endif

        <!-- Font Awesome -->
        <link type="text/css" href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">

        <!-- Nucleo Icons -->
        <link type="text/css" href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">

        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- Popper -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <!-- Perfect Scrollbar -->
        <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>

        <!-- Smooth Scrollbar -->
        <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>

        <!-- Theme CSS -->
        <link type="text/css" href="{{ asset('assets/css/main.'.$dir_mode.'.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('assets/css/custom.'.$dir_mode.'.css') }}" rel="stylesheet">
        
        @if ( !empty($general->font_family) )

          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ $general->font_family }}">

          <style>
            body, .card .card-body {
              font-family: {{ $general->font_family }} !important;
            }
          </style>

        @endif

        @if ( $advanced->header_status == true && $advanced->insert_header != null )
          {!! $advanced->insert_header !!}
        @endif
        
        @livewireStyles

    </head>
    <body class="{{ Cookie::get('theme_mode') }}">

      @if ( $general->maintenance_mode == true && Auth::user()->is_admin != 1 && !Route::is('login') && !Route::is('admin-login') )
        
        @livewire('frontend.maintenance')

      @else
     
        <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

        <main class="main">

          @if ( $general->parallax_status == true )
            <section id="parallax" class="text-white">
              <div class="position-relative overflow-hidden text-center bg-light">
                <span class="mask" style="
                      @if ( $general->overlay_type == 'solid' )

                      background: {{ $general->solid_color }};opacity: {{ $general->opacity }};

                      @elseif( $general->overlay_type == 'gradient' )

                      background: {{ $general->gradient_first_color }};
                      background: -moz-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }}  );
                      background: -webkit-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                      background: linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                      opacity: {{ $general->opacity }};

                      @endif

                "></span>

                @if ( !empty($general->parallax_image) )
                  <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ $general->parallax_image }});filter: blur({{ $general->blur }}px);"></div>
                @else
                  <div class="position-absolute start-0 top-0 w-100 parallax-image" style="background-image: url({{ asset('assets/img/parallax.jpg') }});filter: blur({{ $general->blur }}px);"></div>
                @endif

                <div class="container position-relative zindex-1">
                    <div class="col text-center p-lg-5 mx-auto my-5">
                        @if ( $page->ads_status == true && $advertisement->area1_status == true && $advertisement->area1 != null )
                          <x-frontend.advertisement.area1 :advertisement="$advertisement" />
                        @endif

                        <h1 class="text-white">{{ __('Our Blog') }}</h1>
                        <h4 class="lead text-white letter-normal my-3">{{ __('Stay up to date with the latest news') }}</h4>
                                    
                        @if ( $page->ads_status == true && $advertisement->area2_status == true && $advertisement->area2 != null )
                          <x-frontend.advertisement.area2 :advertisement="$advertisement" />
                        @endif
                    </div>
                </div>
              </div>
              </section>
            @endif

            <section>
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-9">
                        <section id="blog-content">
                          <div class="row row-cards">
                            @if ( $page->ads_status == true && $advertisement->area3_status == true && $advertisement->area3 != null )
                              <x-frontend.advertisement.area3 :advertisement="$advertisement" />
                            @endif
                            
                            @if ( $general->parallax_status == false )
                              <div class="card card-body d-block">
                                    <h1 class="text-white">{{ __('Our Blog') }}</h1>
                                    <h4 class="lead text-white letter-normal my-3">{{ __('Stay up to date with the latest news') }}</h4>
                              </div>
                            @endif

                            @if ( $page->ads_status == true && $advertisement->area4_status == true && $advertisement->area4 != null )
                              <x-frontend.advertisement.area4 :advertisement="$advertisement" />
                            @endif

                            @foreach ($pageTrans as $pageTran)

                                  <div class="col-lg-4 col-sm-6">
                                    <div class="card mb-4">
                                      <div class="card-image border-radius-lg position-relative">
                                        <a href="{{ route('home') . '/' . $pageTran->slug }}">
                                          <img class="w-100 border-radius-lg move-on-hover shadow" src="{{ ($pageTran->featured_image) ? $pageTran->featured_image : asset('assets/img/no-thumb.svg') }}">
                                        </a>
                                      </div>
                                      <div class="card-body">
                                        <h5>
                                          <a href="{{ route('home') . '/' . $pageTran->slug }}" class="text-dark font-weight-bold">{{ $pageTran->title }}</a>
                                        </h5>
                                        <p>{{ $pageTran->short_description }}</p>

                                        <a href="{{ route('home') . '/' . $pageTran->slug }}" class="text-info icon-move-right">{{ __('Read More') }}
                                          <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>

                            @endforeach
                          </div>

                          @if ( $page->ads_status == true && $advertisement->area5_status == true && $advertisement->area5 != null )
                            <x-frontend.advertisement.area5 :advertisement="$advertisement" />
                          @endif

                          <div class="d-flex justify-content-center mt-4">
                            {{ $pageTrans->links() }}
                          </div>
                        </section>
                    </div>

                    <div class="col-lg-3 ml-auto">
                        <x-frontend.sidebar :page="$page" :advertisement="$advertisement" :sidebar="$sidebar" :recentPosts="$recent_posts" :popularTools="$popular_tools" />
                    </div>
                </div>
            </div>

            </section>
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
      @endif
 
    </body>
</html>