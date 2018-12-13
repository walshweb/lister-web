
@extends('layouts.app')

@section('content')


  <div class="row box">
    <div class="ten push_one columns centering white">
      <h3>{{$group->name}}</h3>
    </div>
  </div>

  <div class="row strip">
    <div class="ten columns push_one white">
      <h4>Members</h4>
      <ul class="members">
        @foreach($group->users as $member)
          <li>
            @if($member->id != $user->id)<span class="fas fa-times remove" data-id="{{$member->id}}"></span>@endif{{$member->name}}
          </li>
        @endforeach
        <li data-action="invite" id="invite"><span class="fas fa-plus"></span>Invite</li>
      </ul>
    </div>
  </div>

<div class="row box-top">
  <div class="ten push_one columns">
    <h3>
    <form action="/group/save" method="post">
      @csrf
      <div class="box">
        <input type="text" name="title" value="{{$group->name}}" placeholder="my group name">
      </div>
      <input type="submit" value="Edit">
    </form>
  </div>
</div>

@include('partials.invite')


@push('footer')
  <script>
  $('.members li').on('click', function(){
    $(this).addClass('active');
  });

  $('.remove').on('click', function(){
      var postId = $(this).data("id");
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/group/{{$group->id}}/remove',
        data: {postId: postId},
      })
      $(this).parent().remove();
  });

  $('#invite').on('click', function() {
    $('#invitebox').addClass('active');
    $('#navbtn').data('action', 'closeinvite');
    $('#navbtn').addClass('x');
  });
  </script>
@endpush




@endsection
