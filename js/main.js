$(function() {
  initDatatables();
});

function initDatatables() {
  $('.dataTable').DataTable({
    "paging": true,
    "ordering": true    
  });
}

