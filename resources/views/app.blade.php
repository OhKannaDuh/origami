<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		@routes
		@inertiaHead
		@vite
	</head>
	<body class="antialiased body--dark">
		@inertia
	</body>
</html>
