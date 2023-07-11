<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

		<title>映画シェアアプリ</title>

		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="{{ url(mix('js/app.js')) }}" defer></script>

		<link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">

		<!-- faviconエラー回避 -->
        <link rel="icon" href="data:,">
	</head>

	<body>
		<div class="w-2/3 mx-auto my-10 p-5 bg-gray-400">
			@yield('content')
		</div>
	</body>
</html>