$(document).ready(function () {
  init_search();
  init_search_handling();
  new_tag();
});

// list
function init_search() {
  $('.search_list li').each(function () {
    $(this).attr('data-search-term', $(this).text().toLowerCase());
  });
}

function init_search_handling() {
  $('.search_box').on('keyup', function () {
    var searchTerm = $(this).val().toLowerCase();
    $('.search_list li').each(function () {
      if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
        $(this).show();
      } else {
        $(this).hide();
      }
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
  $('.tag-collection .controls').append($("<input type='textbox' id='tag-input' name='tag-input' />"));
}

function add_make_button() {
  console.log("START ADD MAKE BUTTON");
  $('.tag-collection .controls').append($("<a href='#' class='maak-tag'>Maak</a>"));
  $('.maak-tag').hide();

  $('.maak-tag').on('click', function () {
    tag_text = $('.tag-collection .controls input').val();
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
}
