@extends('layouts.app')

@section('content')



  <div class="row box">
    <div class="ten push_one columns centering white">
      <h3>My List</h3>
    </div>
  </div>

  <div class="row">
    <div class="eleven push_one columns">
      @foreach($incomplete as $task)
          <div class="taskbox">
            <div class="tracker start" data-id="{{$task->id}}"><i class="fas @if(isset($task->stopped_at)) fa-flag-checkered @elseif(isset($task->started_at) && !isset($task->stopped_at)) fa-stop @else fa-play @endif"></i></div>
            <p>{{$task->title}}</p>
            <div class="status" data-id="{{$task->id}}"><div class="checkbox"></div></div>
          </div>
      @endforeach
    </div>
  </div>

  <div class="row">
    <div class="eleven push_one columns">
      @foreach($complete as $task)
        <div class="taskbox">
          <div class="tracker start" data-id="{{$task->id}}"><i class="fas fa-flag-checkered "></i></div>
          <p>{{$task->title}}</p>
          <div class="status" data-id="{{$task->id}}">
            <div class="checkbox">
              <i class="fas fa-check"></i>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>




@endsection
