$(document).ready(function () {
  init_search();
  init_search_handling();
  console.log("yayayayay");
});

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

