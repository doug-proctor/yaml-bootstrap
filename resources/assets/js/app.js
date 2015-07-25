(function(){

	var $toggle = $('.js-toggle'),
		$wrapper = $toggle.closest('.preview');

	$toggle.click(function(ev) {
		ev.preventDefault();
		$wrapper.toggleClass('sidebar-closed');
	})

})();



(function(){

	var $img = $('.intro img');

	$img.mouseover(function() {
		$img.addClass('shrunk');
	})

})();