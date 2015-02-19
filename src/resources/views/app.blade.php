<!DOCTYPE html>
<html lang="en" ng-app="caravel">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="/css/admin.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/loading-bar.css">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
		<main-navigation></main-navigation>


	@yield('content')

	<!-- Scripts -->
	<script src="/js/angular.js"></script>
	<script src="/js/ui-bootstrap.js"></script>
	<script src="/js/lodash.js"></script>
	<script src="/js/restangular.js"></script>
	<script src="/js/loading-bar.js"></script>
	<script src="/js/script.js"></script>
</body>
</html>
