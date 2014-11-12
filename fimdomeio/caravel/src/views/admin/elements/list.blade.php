
@if(empty($fields))
	{{{die('You must provide a $this->fields array on the Controller')}}}
	@endif

@if(empty($contents))
	{{{die('You must provide a $contents variable normally as a result of a db call')}}}
@endif

<h2>{{$title}}</h2>

<div class="mainActions mmt mmb">
	@if(!isset($buttons))
	<a href="{{strtolower($title)}}/create" class="btn btn-primary">add {{str_singular($title)}}</a>
	@else
		@foreach($buttons as $button)
			<a href="{{$button['url']}}" class="btn {{$button['class'] or 'btn-default'}}">{{ $button['title'] }}</a>			
		@endforeach		
	@endif
</div>
@if(!$contents->isEmpty())
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
	<span ng-init="showConfirm{{$content->id}}=false">
	<a class="btn btn-danger" href="#" ng-click="showConfirm{{$content->id}}=true" ng-show="!showConfirm{{$content->id}}">Delete?</a>
	<span class="btn-group" ng-show="showConfirm{{$content->id}}">
	<span class="pull-left xsmt mml smr">delete?</span>
	{{Form::submit('yes', array('class' => 'btn btn-danger')) }}
	<a href="#" class="btn btn-default" ng-click="showConfirm{{$content->id}}=false">no</a>
	</span>
{{ Form::close() }}
	</span>
			</td>
	</tr>
	@endforeach
	</table>
@else
		<div class="alert alert-info text-center lmt" role="alert">There aren't any {{$title}} yet</div>
@endif 


