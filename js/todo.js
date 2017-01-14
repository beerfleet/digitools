$(function () {
  initPickers();
  init_datatable();
});

function initPickers() {
  if ( $(".datepick").size() <= 0 ) {
    return;
  }
  $(".datepick").datepicker({ dateFormat: 'yy-mm-dd' });
  $(".timepick").timepicker();
  $(".datepick, .timepick").on('mouseover', function() {
  	$('.datepick, .timepick').css( 'cursor', 'pointer' );
  });
}

function init_datatable() {
  if ($(".dataTable").size() <= 0) return;
  $('.dataTable').DataTable();  
}

/*
 * outputs say to log
 */
function say(say) {
  console.log(say);
}
