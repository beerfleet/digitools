$(function () {
  initFinishstate();
});

function initFinishstate() {
  $('.finishstate').on('click', function () {
    my_id = $(this).data('todo-id');
    $.ajax({
      url: "/todo/ajax/storestate",
      method: "POST",
      data: {id: my_id, state: this.checked == true ? 1 : 0 },
      success: function (data, status) {
        console.log("State set");
      }
    });
  });
}

function test() {
  console.out('test');
}