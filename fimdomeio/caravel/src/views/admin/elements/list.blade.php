
@if(empty($fields))
	{{{die('You must provide a $this->fields array on the Controller')}}}
	@endif

@if(empty($contents))
	{{{die('You must provide a $contents variable normally as a result of a db call')}}}
@endif

<h2>{{$title}}</h2>
@if(!is_null($contents))
	<table class="table" cellspacing='0'>
	<tr>
	@foreach($fields as $field)
		@if($field != 'id')
		<th>{{$field}}</th>
		@endif
	@endforeach
		<th class="actions">
			Actions
		</th> 
	</tr>
	@foreach($contents as $content)
	<tr>
		@foreach($fields as $field)
			@if($field != 'id')

			<td>
			{{$content->$field}}
			</td>
			@endif
		@endforeach
			<td>
				<div class="btn-group pull-left">
				<a class="btn btn-default" href='view'>view</a>
				<a class="btn btn-default" href='/{{strtolower($title)}}/{{$content->id}}/edit'>edit</a>
				</div>
	{{ Form::open(array('route' => array('boats.destroy', $content->id), 'method' => 'delete', 'class' => 'inline-form')) }}			
	{{Form::submit('Delete', array('class' => 'btn btn-danger')) }}
{{ Form::close() }}

			</td>
	</tr>
	@endforeach
	</table>
@else
		<div class="alert alert-info" role="alert">There aren't any {{$title}} yet</div>
@endif 


