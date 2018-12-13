@php $bodyclass='newlist'@endphp
@extends('layouts.app')

@section('content')


<div class="row box-top">
  <div class="ten push_one columns">
    @if(!$new)
      <p>You are not a member of any groups yet. But don't worry, lets create one together!</p>
    @else
      <p>Let's create a new group!</p>
    @endif

    <form action="/group/save" method="post">
      @csrf
      <div class="box">
        <input type="text" name="title" placeholder="my group name">
      </div>
      <input type="submit" value="create">
    </form>
  </div>
</div>





@endsection
