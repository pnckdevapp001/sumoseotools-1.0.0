@php
  $dir_mode = ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir_mode }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Error 404 (Not Found)') }} - {{ __($homeTitle) }}</title>

        <link rel="shortcut icon" href="{{ $header->favicon }}"/>

        <meta name="robots" content="follow, noindex" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="{{ localization()->getCurrentLocaleRegional() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ __('404 Not Found') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ __('404 Not Found') }}">
        <meta property="og:updated_time" content="@php 

          echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', ''.$page->updated_at.'' )->toIso8601String();

        @endphp">
        @if ( !empty($page->featured_image) )
<meta property="og:image" content="{{ $page->featured_image }}">
        <meta property="og:image:secure_url" content="{{ $page->featured_image }}">
        <meta property="og:image:width" content="{{ Image::make($page->featured_image)->width() }}">
        <meta property="og:image:height" content="{{ Image::make($page->featured_image)->height() }}">
        <meta property="og:image:alt" content="{{ __('404 Not Found') }}">
        <meta property="og:image:type" content="{{ File::extension($page->featured_image) }}">
        @endif

        @php
        if ( !empty($twitter['url']) ) {

          $pregCheck = preg_match('/(?:https?:\/\/)?(?:mobile\.)?(?:www\.)?(?:twitter.com\/)(?:[@])?([A-Za-z0-9-_\.]+)(?:\/status\/(?:[a-z0-9]{0,}))?(?:\?.(?:\=.)?(?:\&.)?)?/', $twitter['url'], $match);

          if ( $pregCheck ){
            echo '<meta name="twitter:title" content="'.__('404 Not Found').'">
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

        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

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

    </head>
    <body class="antialiased {{ Cookie::get('theme_mode') }}">

      @if ( $general->maintenance_mode == true && Auth::id() != 1 && !Route::is('login') && !Route::is('admin-login') )
        
        @livewire('frontend.maintenance')

      @else
            <div class="main-content mt-0 ps">
                <div class="page-header min-vh-100" style="background-image: url('{{ asset('assets/img/404.svg') }}');">
                   <div class="container">
                      <div class="row justify-content-center mx-auto text-center">
                          <h1 class="display-1 text-bolder text-gradient text-primary">Error 404</h1>
                          <h2>{{ __('Oops… You just found an error page') }}</h2>
                          <p class="lead">{{ __('We are sorry but the page you are looking for was not found!') }}</p>
                          <div class="mt-4">
                              <a href="{{ route('home') }}" class="btn bg-gradient-primary">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <line x1="5" y1="12" x2="19" y2="12"></line>
                                      <line x1="5" y1="12" x2="11" y2="18"></line>
                                      <line x1="5" y1="12" x2="11" y2="6"></line>
                                  </svg>
                                  {{ __('Go to Homepage') }}
                              </a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

      @endif

    </body>
</html>