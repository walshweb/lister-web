<div class="background-overlay" id="newlist">
  <div class="row half white centering">
    <h3>New List</h3>
    <form action="/list/new" method="post" class="centering" autocomplete="off">
      @csrf
      <div class="box-sml">
        <input type="text" name="list" placeholder="List Name" required>
      </div>

      @if(isset($list))
        <input type="hidden" name="group" value="{{$list->groups->first()->id}}">
      @elseif(isset($groups) && count($groups)>1)
        <div class="box-sml">
          <select name="group" id="group">
            @foreach($groups as $group)
              <option value="{{$group->id}}">{{$group->name}}</option>
            @endforeach
          </select>
        </div>
      @endif
      <div class="box-sml">
        <input type="text" name="icon" placeholder="Select an Icon" id="icon-selector">
      </div>



      <ul class="iconlist" id="icons">
        <li class="full"><input type="text" placeholder="Search..." id="iconsearch" onkeyup="searchicons()"></li>
          @foreach($icons as $icon)
            <li class="icon" data-icon="{{$icon->full}}"><i class="{{$icon->full}}"></i><icon>{{$icon->full}}</icon></li>
          @endforeach
      </ul>

      <input type="submit" value="create">
    </form>
  </div>
</div>

@push('footer')
  <script>
    $('#icon-selector').on('click', function(){
      $('.iconlist').addClass('active');
    });
    $('.icon').on('click', function(){
      $('.iconlist').removeClass('active');
      var icon = $(this).data('icon');
      $('.icon.active').removeClass('active');
      $(this).addClass('active');
      $('#icon-selector').val(icon);
    });
    function searchicons() {
  	    // Declare variables
  	    var input, filter, ul, li, a, i;
  	    input = document.getElementById('iconsearch');
  	    filter = input.value.toUpperCase();
  	    parent = document.getElementById("icons");
  	    listings = parent.getElementsByClassName('icon');

  	    // Loop through all list items, and hide those who don't match the search query
  	    for (i = 0; i < listings.length; i++) {
  	        a = listings[i].getElementsByTagName("icon")[0];
  	        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
  	            listings[i].style.display = "";
  	        } else {
  	            listings[i].style.display = "none";
  	        }
  	    }
  	}
  </script>
@endpush
