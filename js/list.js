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

function search_list() {

  // Declare variables
  /*var input, filter, ul, li, a, i;
   input = document.getElementById('myInput');
   filter = input.value.toUpperCase();
   ul = document.getElementById("myUL");
   li = ul.getElementsByTagName('li');
   
   // Loop through all list items, and hide those who don't match the search query
   for (i = 0; i < li.length; i++) {
   a = li[i].getElementsByTagName("a")[0];
   if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
   li[i].style.display = "";
   } else {
   li[i].style.display = "none";
   }
   }*/
}
