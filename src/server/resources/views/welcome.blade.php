<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>

		</style>
			<link href="/css/admin.css" rel="stylesheet">

	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
			<div class="content col-md-12 text-center">
				<h1 class="title lmb" style="color: white; font-size: 64px;">Caravel 0.2</h1>
				@if(Auth::check())
					<h3 class="greeting">Hey {{  Auth::user()->name }}! </h3>
					<a href="/auth/login" class="btn btn-primary">admin</a>
					<a href="/auth/logout" class="btn btn-primary">logout</a>
				@else
					@if($err == 'settingNotFound')
						<div class="alert alert-warning">Database does not appear to have been properly seeded.</div>
					@else 
						<a href="/auth/login" class="btn btn-primary">Login</a>
						@if($allowRegistration)
							<a href="/auth/register" class="btn btn-primary">Register</a>
						@endif
					@endif
				@endif
			</div>
			</div>
		</div>
	</body>
</html>
