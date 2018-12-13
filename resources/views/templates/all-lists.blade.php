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
    @foreach($lists as $checklist)
      <a href="/list/{{$checklist->id}}">
        <div class="listbox">
          <p>{{$checklist->title}}</p>
        </div>
      </a>
    @endforeach
  </div>
</div>





@endsection
