
@if(empty($fields))
	{{{die('You must provide a $this->fields array on the Controller')}}}
	@endif

@if(empty($contents))
	{{{die('You must provide a $contents variable normally as a result of a db call')}}}
@endif

<h2>{{$title}}</h2>
@if(!empty($contents['items']))
	<table class="table" cellspacing='0'>
	<tr>
	@foreach($fields as $field)
		<th>{{$field}}</th>
		@endforeach
		<th class="actions">
			Actions
		</th> 
	</tr>
	@foreach($contents as $content)
	<tr>
		@foreach($fields as $field)
			<td>
			{{$content->$field}}
			</td>
			@endforeach
			<td>
				<a class="btn btn-default" href='view'>view</a>
				<a class="btn btn-default" href='edit'>edit</a>
				<a class="btn btn-default" href='delete'>delete</a>
			</td>
	</tr>
	@endforeach
	</table>
	@else
		<div class="alert alert-info" role="alert">There aren't any {{$title}} yet</div>
@endif


