<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>CRUD with Vue.js</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

	<div id="app" class="container">
		@yield('content')
	</div>

	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="/js/app.js"></script>

	@stack('scripts')
</body>
</html>
