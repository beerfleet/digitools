$(function() {
  initPicker();
});

function initPicker(){
  $(".datepick").on('click', function() {
    say("clicked");
  });
}

/*
 * outputs say to log
 */
function say(say) {
  console.log(say);
}
