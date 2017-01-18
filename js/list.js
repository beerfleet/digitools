$(document).ready(function () {
  init_search();
  init_search_handling();
  init_mark_for_deletion();
  init_datatable();
  init_delete_selected();

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
    $('.dataTable').DataTable();
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
        deletions.push( $(this).data('entry-id') );
        $(this).parent().parent().remove();
      };
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

