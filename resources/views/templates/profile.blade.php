@php $bodyclass="all-lists"; @endphp
@extends('layouts.app')

@section('content')


<div class="row box">
  <div class="ten push_one columns centering white">
    <h3>Welcome {{$user->name}}</h3>
  </div>
</div>

<div class="row">
  <div class="ten push_one columns">
    <form action="/edit/profile" method="POST">
      @csrf
      <input type="text" name="name" value="{{$user->name}}" placeholder="username">
      <div class="strip">
        <input type="text" name="email" value="{{$user->email}}" placeholder="email">
      </div>
      <input type="submit" value="Update">
    </form>
  </div>
</div>





@endsection
