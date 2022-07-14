<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ ( Cookie::get('dir_mode') ) ? Cookie::get('dir_mode') : 'ltr' }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ __('Profile - SumoSEOTools') }}</title>

    <x-admin.headerAssets />

    @livewireStyles

</head>
<body class="g-sidenav-show antialiased bg-gray-100 {{ Cookie::get('theme_mode') }}">

    @livewire('admin.profile')

    <x-admin.footerAssets />

    @livewireScripts
</body>
</html>