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
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="false">
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
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                      <tbody>
                                        <tr>
                                            <td class="align-middle">{{ __('Sitemap URL') }}</td>
                                            <td class="align-middle">{{ url('/sitemap.xml') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">{{ __('Sitemap File') }}</td>
                                            <td class="align-middle">
                                                <a href="{{ url('/sitemap.xml') }}" class="btn bg-gradient-success" target="_blank">
                                                    <i class="fas fa-eye fa-fw"></i>
                                                    {{ __('View Sitemap File') }}
                                                </a>
                                            </td>
                                        </tr>
                                      </tbody>
                                    </table>
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