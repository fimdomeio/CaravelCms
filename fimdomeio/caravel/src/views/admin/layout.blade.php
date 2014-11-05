<!DOCTYPE html>
<html lang='en' ng-app>
<head>
	<meta charset='UTF-8' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title") | Caravel</title>
	<link href='/packages/fimdomeio/caravel/css/admin/style.css' rel='stylesheet' />
</head>
<body>
	@include("caravel::admin.nav")
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
