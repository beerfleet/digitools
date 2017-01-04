$(document).ready(function () {
  init_search();
  init_search_handling();
  new_tag();
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


