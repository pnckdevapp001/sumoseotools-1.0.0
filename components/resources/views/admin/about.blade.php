<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('About - SumoSEOTools') }}</title>

    <x-admin.headerAssets />

</head>
<body class="g-sidenav-show antialiased bg-gray-100 {{ Cookie::get('theme_mode') }}">

    <div class="wrapper">

      <x-admin.sidebar />

      <div class="main-content position-relative border-radius-lg ps">
        
            <!-- Begin::Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="false">
             <div class="container-fluid px-0">

                <x-admin.breadcrumbs />

                <x-admin.navright />

             </div>
            </nav>
            <!-- End::Navbar -->

            <div class="page-body">
                <div class="container-fluid py-4">
                  <div class="row">
                    <div class="col">

						<div class="card">
							<div class="card-body">
								<p>{{ __('Thank you for purchasing our SumoSEOTools script. We have put in lots of love in developing this product and are excited that you have chosen this script for your website. We hope you find it easy to use our product.') }}</p>
								<a class="btn btn btn-icon btn-3 bg-gradient-success" href="https://codecanyon.net/item/sumoseotools-online-seo-tools-script/37326812" target="_blank">
                                    <i class="fas fa-download fa-fw"></i>
                                    {{ __('Download Now') }}
                                </a>

								<a href="https://codecanyon.net/user/themeluxury" target="_blank" class="btn btn btn-icon btn-3 bg-gradient-primary">
                                    <i class="fas fa-life-ring fa-fw"></i>
                                    {{ __('Get Support') }}
                                </a>

								<div class="changelog {{ ( Cookie::get('theme_mode') == 'theme-light') ? 'bg-gray-100' : '' }} rounded mt-3">
									<h5>{{ __('Changelog') }}</h5>
									<pre>
										{{ file_get_contents('./changelog.txt') }}
									</pre>
								</div>

							</div>
						</div>

                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

</body>
</html>