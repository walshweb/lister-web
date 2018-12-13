	<footer>

	</footer>
	<div class="notice @if (session('notice')) active @endif">

        {{ session('notice') }}
		
	</div>
</div>
		@stack('footer')
		<script>
	  $('#navbtn').on('click', function(){
	    var action = $(this).data('action');
	    if(action == 'newlist'){
	      console.log('newlist');
	      $('#newlist').addClass('active');
	      $(this).data('action', 'closelist');
	      $(this).addClass('x');
	    }
	    if(action == 'closelist'){
	      console.log('closelist');
	      $('#newlist').removeClass('active');
	      $(this).data('action', 'newlist');
	      $(this).removeClass('x');
	    }
	    if(action == 'closetask'){
	      console.log('close task');
				$('#newtask').removeClass('active');
				$(this).data('action', 'newlist');
				$(this).removeClass('x');
	    }
			if(action == 'closemenu'){
	      console.log('close main menu');
				$('#main-menu').removeClass('active');
				$(this).data('action', 'newlist');
				$(this).removeClass('x');
	    }
			if(action == 'closeinvite'){
	      console.log('close invite');
				$('#invitebox').removeClass('active');
				$(this).data('action', 'newlist');
				$(this).removeClass('x');
	    }
	  });
		$('#taskbtn').on('click', function() {
			$('#newtask').addClass('active');
			$('#navbtn').data('action', 'closetask');
			$('#navbtn').addClass('x');
		});
		$('#menubtn').on('click', function(){
			$('#main-menu').addClass('active');
			$('#navbtn').data('action', 'closemenu');
			$('#navbtn').addClass('x');
		});
		$('#manage-groups').on('click', function(){
			$('#manage-groups ul').toggleClass('active');
		});
	  </script>

		<script>
    $(document).on('click', '.status', function(e){
      var postId = $(this).data("id");
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
        method: 'POST',
        url: '/task/status/update',
        data: {postId: postId},
      })
      if($(this).html()=='<div class="checkbox"></div>'){
        $(this).html('<div class="checkbox"><i class="fas fa-check"></i></div>');
      }
      else {
        $(this).html('<div class="checkbox"></div>');
      }
    });
		$(document).on('click', '.tracker', function(e){
      var postId = $(this).data("id");
			if($(this).html()=='<i class="fas  fa-flag-checkered "></i>'){

			}
      else if($(this).html()=='<i class="fas  fa-stop "></i>'){
				$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	      });
	      $.ajax({
	        method: 'POST',
	        url: '/task/time/update',
	        data: {postId: postId},
	      })
        $(this).html('<i class="fas  fa-flag-checkered "></i>');
				$(this).parent().children('.status').html('<div class="checkbox"><i class="fas fa-check"></i></div>');
      }
      else {
				$.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	      });
	      $.ajax({
	        method: 'POST',
	        url: '/task/time/update',
	        data: {postId: postId},
	      })
        $(this).html('<i class="fas  fa-stop "></i>');
      }
    });
		function removenotification(){
		  $('.notice').removeClass('active');
		};
		setTimeout(removenotification, 3000);
    </script>


		<script src="/assets/js/flawless.js"></script>
  </body>
</html>