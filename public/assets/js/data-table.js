$(document).ready(function () {
  $('#dataTableExample').DataTable();

  $('input.column_filter').on('keyup click', function () {
    filterColumn($('#op').val());
  });

  $('#op').on('click', function () {
    $('#col0_filter').val("")
  });
});



function filterColumn(i) {
  $('#dataTableExample').DataTable().column(i).search(
    $('#col0_filter').val()
  ).draw();
}

$('#dataTableExample').dataTable({ dom: 'lrtp' });