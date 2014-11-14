@extends('admin.layout')

@if(empty($title))
	{{{die('You must provide $this->title on the Controller')}}}
@endif
@section('title'){{ $title }}@stop

@section('content')
	@include('admin.elements.list')

@stop
