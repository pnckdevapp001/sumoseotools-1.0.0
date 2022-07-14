<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Proxy - SumoSEOTools') }}</title>

    <x-admin.headerAssets />

    @livewireStyles

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
						 @livewire('admin.settings.proxy')
                    </div>
                  </div>
                </div>
            </div>

            <x-admin.footer />
      </div>
    </div>

    <x-admin.footerAssets />

    @livewireScripts

    <script>
    (function( $ ) {
        "use strict";

        document.addEventListener('livewire:load', function () {

            window.addEventListener('swal:modal', event => {

                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger'
                  },
                  buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: event.detail.title,
                  text: event.detail.text,
                  icon: event.detail.type,
                  showCancelButton: true,
                  confirmButtonText: "{{ __('Yes, delete it!') }}",
                  cancelButtonText: "{{ __('Cancel') }}"
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.livewire.emit('onDeleteProxy', event.detail.id)
                  }
                });

            });
        
            window.addEventListener('closeModal', event => {
                $('#' + event.detail.id).modal('hide');
            });

            window.addEventListener('showModal', event => {
                $('#' + event.detail.id).modal('show');
            });

            window.addEventListener('alert', event => {
                toastr[event.detail.type](event.detail.message);
            });

        });

    })( jQuery );
    </script>

</body>
</html>