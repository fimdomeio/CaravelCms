@if(empty($title))
	{{{die('You must provide a $title for this page')}}}
@endif


@if(empty($fields))
	{{{die('You must provide a $fields array with the fields you want to show')}}}
@endif
@if(empty($contents))
	{{{die('You must provide a $contents variable with the contents you want to show')}}}
@endif

<h2>{{$title}}</h2>
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


