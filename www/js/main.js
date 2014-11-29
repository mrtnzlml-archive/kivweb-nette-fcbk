$(function () {

	$('body').on('click', 'a[data-confirm]', function (event) {
		var question = $(this).data('confirm');
		if (!confirm(question)) {
			event.stopImmediatePropagation();
			event.preventDefault();
		}
	});

});
