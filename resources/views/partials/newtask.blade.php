<div class="background-overlay" id="newtask">
  <div class="row half white">
    <form action="/task/new" method="post" class="centering" autocomplete="off">
      @csrf
      <h3 class="box">New Task</h3>
      @if(isset($members) && count($members)>1)
        <p class="centering">This task is for...
        <select name="assigned" id="assignto" class="assignto">
          @foreach($members as $member)
              <option value="{{$member->id}}" @if($member == $user)selected @endif>{{$member->name}}</option>
          @endforeach
        </select>
        </p>
      @else
        <input type="hidden" name="assigned" id="assignto" value="{{$user->id}}">
      @endif
      <div class="box">
        <input type="text" name="task" placeholder="Task Name" required>
      </div>
      @isset($list)
        <input type="hidden" name="list" value="{{$list->id}}">
      @endisset



      <input type="submit" value="create">
    </form>
  </div>
</div>

