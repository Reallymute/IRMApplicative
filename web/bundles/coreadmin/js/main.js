$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    changeMonth: true,
    changeYear: true
});

$.hideAll = function () {
    $('.display-none').hide();
};

$(document).ready(function() {
	$(".form-horizontal select").select2();

	$("table").stickyTableHeaders();
	
});

// $(document).ready(function() {

//     $('#search [placeholder]').focus(function() {
//       var input = $(this);
//       if (input.val() == input.attr('placeholder')) {
//         input.val('');
//         input.removeClass('placeholder');
//       }
//     }).blur(function() {
//       var input = $(this);
//       if (input.val() == '' || input.val() == input.attr('placeholder')) {
//         input.addClass('placeholder');
//         input.val(input.attr('placeholder'));
//       }
//     }).blur();
// });