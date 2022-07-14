@php
  $dir_mode = ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir_mode }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __($pageTitle) }}</title>

        <link rel="shortcut icon" href="{{ $header->favicon }}"/>

        <meta name="description" content="{{ __($pageTrans->short_description) }}" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="{{ localization()->getCurrentLocaleRegional() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ __($pageTitle) }}">
        <meta property="og:description" content="{{ __($pageTrans->short_description) }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ __($pageTitle) }}">
        <meta property="og:updated_time" content="@php 

          echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', ''.$page->updated_at.'' )->toIso8601String();

        @endphp">
        @if ( !empty($page->featured_image) )
<meta property="og:image" content="{{ $page->featured_image }}">
        <meta property="og:image:secure_url" content="{{ $page->featured_image }}">
        <meta property="og:image:width" content="{{ Image::make($page->featured_image)->width() }}">
        <meta property="og:image:height" content="{{ Image::make($page->featured_image)->height() }}">
        <meta property="og:image:alt" content="{{ __($pageTitle) }}">
        <meta property="og:image:type" content="{{ File::extension($page->featured_image) }}">
        @endif

        @php
        if ( !empty($twitter['url']) ) {

          $pregCheck = preg_match('/(?:https?:\/\/)?(?:mobile\.)?(?:www\.)?(?:twitter.com\/)(?:[@])?([A-Za-z0-9-_\.]+)(?:\/status\/(?:[a-z0-9]{0,}))?(?:\?.(?:\=.)?(?:\&.)?)?/', $twitter['url'], $match);

          if ( $pregCheck ){
            echo '<meta name="twitter:title" content="'.__($pageTitle).'">
        <meta name="twitter:description" content="'.__($pageTrans->short_description).'">
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
            @livewire('frontend.pages', [
              'page'          => $page,
              'pageTrans'     => $pageTrans,
              'homeTitle'     => $homeTitle,
              'general'       => $general,
              'profile'       => $profile,
              'menus'         => $menus,
              'header'        => $header,
              'footer'        => $footer,
              'captcha'       => $captcha,
              'notice'        => $notice,
              'advanced'      => $advanced,
              'advertisement' => $advertisement,
              'socials'       => $socials,
              'twitter'       => $twitter,
              'sidebar'       => $sidebar,
              'recent_posts'  => $recent_posts,
              'popular_tools' => $popular_tools
            ])

            @livewireScripts

      @endif

    </body>
</html>