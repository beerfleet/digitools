/*
 * VOORBEELD: AJAX, JSON, ASYNC
 */

$(document).ready(function () {
  init_onchange_event();
});

function init_onchange_event() {
  $('.tag-list .tag span input:checkbox').each(function (index, value) {

    $(this).on('click', function () {
      t_id = $(this).parent().parent().data('tag-id');
      l_id = $(this).parent().parent().data('log-id');
      checked = value.checked;
      $.ajax({
        url: "/tags/edit",
        method: "POST",
        data: {tag_id: t_id, log_id: l_id},
        dataType: "json",
        success: function (result) {
          tag = result['tag'];
          status = result['status'];
          if (status == 1) {
            $div = $('<div class="tag">' + tag + '</div>');
            $('.tag-bag').append($div);
          }
        },
        fail: function (xhr, error) {
          console.debug(xhr);
          console.debug(error);
          console.log("problem storing tag.");
        }
      });
    });
  });

}