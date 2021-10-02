<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('pageheader')</title>
    <!-- stili -->
    @yield('htmlheadassets')
	<style>

	</style>
</head>
<body>
	@yield('content')
    @yield('htmlbodyassets')
</body>
</html>