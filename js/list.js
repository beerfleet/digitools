$(document).ready(function () {
  init_search();
  init_search_handling();
  init_mark_for_deletion();
  init_datatable();
  init_delete_selected();
  init_carousel();
});

// list
function init_search() {
  $('.search_list li').each(function () {
    srch_terms = $(this).find(".item_created").text().toLowerCase() + " " + $(this).find(".item_entry_box").text().toLowerCase();
    //console.log(srch_terms);
    $(this).attr('data-search-term', srch_terms);
  });
}

function init_search_handling() {
  $('.search_box').on('keyup', function () {
    var searchTerm = $(this).val().toLowerCase();
    $('.search_list li').each(function () {
      //if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
      if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
}

function init_datatable() {
  if ($('.dataTable').length > 0) {
    $('.dataTable').DataTable({
      "order": []
    });
  }
}

function init_mark_for_deletion() {
  $('.mark-delete input[type="checkbox"]').on('click', function () {
    log_id = $(this).data('entry-id');
    chk_state = $(this).is(':checked');
    $.post('/log/mark-for-deletion', {id: log_id, state: chk_state}, function (result) {
      console.log('Marked for deletion.');
    });
  });
}

/**
 * Allows for deletion of filtered results only
 */
function init_delete_selected() {
  $('#delete_selected').on('click', function () {
    deletions = [];
    $('#logs_table_manage .mark-delete input[type=checkbox]').each(function () {
      if ($(this).is(':checked')) {
        deletions.push($(this).data('entry-id'));
        $(this).parent().parent().remove();
      }
      ;
    });
    $.ajax({
      url: "/admin/delete-marked-logs",
      type: "POST",
      data: {log_ids: deletions},
      dataType: "json",
      success: function (res) {

      }
    });
  });
}

function init_carousel() {
  $carousel = $('#carousel');
  // fetch linked images
  $.ajax({
    url: "/images/fetch",
    type: "POST",
    data: {log_id: $('#log_id').text()},
    dataType: "json",
    success: function (res) {
      if (res.length > 0) {
        display_carousel(res);
      } else {
        $carousel.append('<p class="error">Er zijn geen afbeeldingen</p>');
      }
    }
  });
}

function display_carousel(res) {
  $carousel = $('#carousel');
  $carousel.addClass('carousel slide');
  $carousel.attr('data-ride', 'carousel');

  // Image indicators
  $indicators = $('<ol class="carousel-indicators"></ol>');
  for (var i = 0; i < res.length; i++) {
    $li = $('<li data-target="#carousel" data-slide-to="' + i + '"></li>');
    if (i == 0) {
      $li.addClass('active');
    }
    $indicators.append($li);
  }
  $carousel.append($indicators);

  // slides
  $slides_wrapper = $('<div class="carousel-inner" role="listbox"></div>');
  for (var i = 0; i < res.length; i++) {
    $div = $('<div class="item"></div>');
    if (i == 0) {
      $div.addClass('active');
    }
    number = i + 1;
    $img = $('<img src="/' + res[i] + '" alt="Picture ' + number + '">');
    $div.append($img);
    $slides_wrapper.append($div);
  }
  $carousel.append($slides_wrapper);

  // controls, left and right
  $left = $('<a class="left carousel-control" href="#carousel" role="button" data-slide="prev"></a>');
  $left.append('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>');
  $left.append('<span class="sr-only">Previous</span>');
  $right = $('<a class="right carousel-control" href="#carousel" role="button" data-slide="next"></a>');
  $right.append('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>');
  $right.append('<span class="sr-only">Next</span>');
  $carousel.append($left);
  $carousel.append($right);
}

