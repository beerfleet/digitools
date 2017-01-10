$(document).ready(function () {
  init_search();
  init_search_handling();
  init_mark_for_deletion();
  init_datatable();
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
  $('.dataTable').DataTable;
}

function init_mark_for_deletion() {
  $('.mark-delete input[type="checkbox"]').on('click', function() {
    log_id = $(this).data('entry-id');
    chk_state = $(this).is(':checked');
    $.post('/log/mark-for-deletion', {id: log_id, state: chk_state}, function (result) {
      console.log(result['kaka']);
    });
  });
}

