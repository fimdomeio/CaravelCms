@extends('caravel::admin.layout')

@if(empty($title))
	{{{die('You must provide $this->title on the Controller')}}}
@endif

@section('title'){{ $title }}@stop

@section('content')
	@include('caravel::admin.elements.list')

@stop
