// Expand or show element js
/*
To display an expanding element, give it the class of 'expander' and a data attribute of expand to denote what object to expand.

Example:
    <h2 class="expander" data-expand="#expand-me">Link Title</h2>

Then, attach the necessary id to the element you wish to expand, and give it the expander class like so:

Example:

<div id="expand-me" class="expandable">
  <p>Content</p>
</div>

*/
	$('.expander').click(function() {
		$('.content').find('.expand').removeClass('expand');


	$($(this).data('expand')).addClass('expand');
		$(this).addClass('expand');
	});


// Modal js
/*
To activate a modal box, give it the class of 'modalbtn' and a data attribute of modal.

Example:
    <li class="modalbtn" data-modal="#modalname"><a>Link Title</a></li>


Then, create an html modal box with classes like so, and place it anywhere on your webpage. Towards the footer is a good place.

Example:
    <div id="modalname" class="modal" style="display: none;">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">×</span>
          <h2>Modal Header Name</h2>
        </div>
        <div class="modal-body">
          <p>Modal Content Goes Here</p>
        </div>
      </div>

    </div>

*/
var modal = false;
$('.modalbtn').click(function(event) {
	event.preventDefault();
	$('.modal').css('display','none');
	$($(this).data('modal')).css('display','block');
	modal = true;
});

$('.close').click(function() {
	$('.modal').css('display','none');
});

$('.modal').click(function(event) {
	if($(event.target).parents('.modal-content').andSelf().is('.modal')){
		$('.modal').css('display','none');
	}
});
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	var modal = document.getElementsByClassName('modal');
    if (event.target===modal) {
        $('.modal').css('display','none');
    }
};
