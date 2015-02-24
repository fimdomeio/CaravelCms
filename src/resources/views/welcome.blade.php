<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;

			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				margin-top: -2em;
				font-size: 96px;
				margin-bottom: 40px;
				font-weight: 100;
				color: #666;
			}

			.greeting {
				font-weight: 100;
				margin-bottom: 48px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
			<link href="/css/admin.css" rel="stylesheet">

	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Caravel 0.2</div>
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
	</body>
</html>
