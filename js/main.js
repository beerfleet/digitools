$(function() {
  initFinishstate();
});

function initFinishstate() {
  $('.finishstate').on('click', function() {    
    id = $(this).data('todo-id');
    alert(id);
  });
}

function test() {
  console.out('test');
}