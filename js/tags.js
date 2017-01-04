/*
 * VOORBEELD: AJAX, JSON, ASYNC
 */

$(document).ready(function () {
  init_onchange_event();
  new_tag();
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

// tags
function new_tag() {
  $('.tag-collection .nieuwe-tag a').on('click', function () {
    $(this).hide();
    add_input_box();
    tag_input_not_empty();
    add_make_button();
  });
}

function tag_input_not_empty() {
  $('#tag-input').on('keyup', function () {
    spaces_removed = $(this).val().replace(/\s/g, '');
    input_length = spaces_removed.length;
    if (input_length > 0) {
      $('.maak-tag').show();
    } else {
      $('.maak-tag').hide();
    }
  });
}

function add_input_box() {
  $('.tag-collection .controls').append($("<input type='textbox' id='tag-input' name='tag-input' class='form-control'/>"));
}

function ajax_retrieve_tag_id(tag_text) {
  $.ajax({
    url: "/tag/search",
    type: "POST",
    data: {tag: tag_text},
    dataType: 'json',
    success: function (result) {
      console.log("+HAHAHA " + result['id']);
      tag_id = result['id'];
      $li = $('<li class="tag" data-tag-id="' + tag_id + '">' + tag + ' </li>');
      $li.append('<span><input id="tags" name="tags_chk['+tag_id+']" type="checkbox" class="placeholder"> </span>');
      $('.tag-bag .tag-list').append($li);
    }
  });
}

function ajax_add_new_tag(tag_text) {
// Add new tag
  $.ajax({
    url: "/tags/add",
    type: "POST",
    data: {tag: tag_text},
    dataType: "json",
    success: function (result) {
      tag = result['tag'];
      status = result['status'];
      $('.maak-tag').remove();
      $('#tag-input').remove();
      $(".nieuwe-tag a").show();

      // tag is valid and stored
      if (status == 1) {
        ajax_retrieve_tag_id(tag_text);
      }

    },
    fail: function (xhr, error) {
      console.debug(xhr);
      console.debug(error);
      console.log("problem storing tag.");
    }
  });
}

function add_make_button() {
  console.log("START ADD MAKE BUTTON");
  $('.tag-collection .controls').append($("<a href='#' class='maak-tag'>Maak</a>"));
  $('.maak-tag').hide();

  $('.maak-tag').on('click', function () {
    tag_text = $('.tag-collection .controls input').val();
    ajax_add_new_tag(tag_text);
  });
}