// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    language: {
      // url: "{{ asset('datatables/media/french.json') }}"
      url: "datatables/media/french.json"
    }
  });
});
 alert('test');