<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>映画シェアアプリ</title>

		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
		<script src="{{ asset('js/app.js') }}" defer></script>

		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>

	<body>
		<div class="w-2/3 mx-auto my-10 p-5 bg-gray-400">
			@yield('content')
		</div>
	</body>
</html>