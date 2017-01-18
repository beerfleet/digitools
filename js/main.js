$(function () {
  initFinishstate();
  init_isadmin_handlers();
  init_isenabled_handlers();
});

function initFinishstate() {
  $('.finishstate').on('click', function () {
    my_id = $(this).data('todo-id');
    $.ajax({
      url: "/todo/ajax/storestate",
      method: "POST",
      data: {id: my_id, state: this.checked == true ? 1 : 0},
      success: function (data, status) {
        console.log("State set");
      }
    });
  });
}

function init_isadmin_handlers() {
  $('.check-admin').on('click', function () {
    chk_state = $(this).is(':checked');

    data_user_id = $(this).data('user-id');
    $.ajax({
      url: "/admin/toggleadmin",
      type: "POST",
      data: {state: chk_state, user_id: data_user_id},
      dataType: "json",
      success: function (res) {

      }
    });
  });
}

function init_isenabled_handlers() {
  $('.check-enabled').on('click', function () {
    chk_state = $(this).is(':checked');

    data_user_id = $(this).data('user-id');
    $.ajax({
      url: "/admin/toggleenabled",
      type: "POST",
      data: {state: chk_state, user_id: data_user_id},
      dataType: "json",
      success: function (res) {

      }
    });
  });
}

function say(text) {
  console.log(text);
}