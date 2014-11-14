<!DOCTYPE html>
<html lang='en' ng-app>
<head>
	<meta charset='UTF-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title") | Caravel</title>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link href='/packages/fimdomeio/caravel/css/admin/style.css' rel='stylesheet' />
</head>
<body>
	<div class="lmt container-fluid">
		@yield("content")
	</div>

	<!-- SCRIPTS -->
	<script src='/packages/fimdomeio/caravel/js/admin/jquery-devel.js' type='text/javascript'></script>
	<script src='/packages/fimdomeio/caravel/js/admin/bootstrap-devel.js' type='text/javascript'></script>
	<script src='/packages/fimdomeio/caravel/js/admin/angular-devel.js' type='text/javascript'></script>
	<script src='/packages/fimdomeio/caravel/js/admin/myscript.js' type='text/javascript'></script>
	<!-- END SCRIPTS -->
</body>
</html>