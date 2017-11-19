<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PhotoShow</title>
	<link rel="stylesheet" href="/bootstrap/bootstrap.css">
</head>
<body>
	<div class="container">
		@include('inc.topbar')
		<div class="row">
		@include('inc.messages')
			@yield('content')
		</div>
	</div>
</body>
</html>