<div class="plusbtn" id="navbtn" data-action="newlist">
  <span class="fas fa-plus"></span>
  <!-- newlist closelist closetask -->
</div>
<div class="menubtn" id="menubtn" data-action="menu">
  <span class="fas fa-cogs"></span>
</div>

<div class="listnav">
  @isset($lists)
    @foreach($lists as $nav)
      <a href="/list/{{$nav->id}}">
        <div class="list @if(isset($list) && $nav->id==$list->id)active @endif">
          @isset($nav->icon)
            <i class="{{$nav->icon}}"></i>
          @else
            {{$nav->title}}
          @endif
        </div>
      </a>
    @endforeach
  @endisset
</div>

<div class="background-overlay" id="main-menu">
<div class="main-menu">
  <ul>
    <a href="/mylist"><li>My List</li></a>
    <a href="/"><li>View All Lists</li></a>
    <a href="/profile"><li>About Me</li></a>
    <li id="manage-groups">Manage Groups
      <ul>
        @foreach($groups as $group)
        <a href="/group/manage/{{$group->id}}"><li>{{$group->name}}</li></a>
        @endforeach
        <a href="/group/new"><li>Create New Group</li></a>
      </ul>
    </li>
  </ul>
</div>
</div>

