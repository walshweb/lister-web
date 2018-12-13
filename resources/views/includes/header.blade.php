<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
  <title>@if(isset($list)){{$list->title}}@elseif(isset($bodyclass)) {{$bodyclass}} @endif | Clara & Andrew's Awesome List App </title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/app.css">
	<script src="/assets/js/jquery-2.0.2.min.js"></script>
  @stack('header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>

  <body @if(isset($bodyclass)) class="{{$bodyclass}}" @endif>
		<div class="app">
	@if(isset($bodyclass) && $bodyclass == 'login')

	@elseif(isset($bodyclass) && $bodyclass == 'newlist')

	@else
		@include('partials.navigation')
		@include('partials.newlist')
		@include('partials.newtask')
	@endif
