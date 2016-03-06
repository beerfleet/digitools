$(function () {
  initPickers();
});

function initPickers() {
  $(".datepick").datepicker();
  $(".timepick").timepicker();
  $(".datepick, .timepick").on('mouseover', function() {
  	$('.datepick, .timepick').css( 'cursor', 'pointer' );
  });
}

/*
 * outputs say to log
 */
function say(say) {
  console.log(say);
}
