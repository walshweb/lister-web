<div class="background-overlay" id="invitebox">
  <div class="row half white centering">
    <h3>Invite People</h3>
    <form action="/group/{{$group->id}}/invite" method="post" class="centering" autocomplete="off">
      @csrf
      <div class="box-sml-top" id="invitecont">
        <input type="text" name="invite[]" placeholder="Email or phone number">
      </div>
      <div class="strip centering">
        <i class="fas fa-plus" id="addinvite"></i>
      </div>

      <input type="submit" value="Send Invite">
    </form>
  </div>
</div>

@push('footer')
  <script>
  $('#addinvite').on('click', function(){
    $('#invitecont').append('<input type="text" name="invite[]" placeholder="Email or phone number">');
  });
  </script>
@endpush