<!-- Vendor js -->
<script src="{{$baseUrl}}js/vendor.min.js"></script>

<!-- Daterangepicker js -->
<script src="{{$baseUrl}}vendor/daterangepicker/moment.min.js"></script>
<script src="{{$baseUrl}}vendor/daterangepicker/daterangepicker.js"></script>

<!-- Apex Charts js -->
{{-- <script src="{{$baseUrl}}vendor/apexcharts/apexcharts.min.js"></script> --}}

<!-- Plugin css -->
<script src="{{$baseUrl}}vendor/jquery-toast-plugin/jquery.toast.min.js"></script>

<!-- Vector Map js -->
<script src="{{$baseUrl}}vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{$baseUrl}}vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- App js -->
<script src="{{$baseUrl}}js/app.min.js"></script>

<!-- Datatables js -->
<script src="{{$baseUrl}}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{$baseUrl}}vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!--  Select2 Plugin Js -->
<script src="{{$baseUrl}}vendor/select2/js/select2.min.js"></script>

<!-- Daterangepicker Plugin js -->
<script src="{{$baseUrl}}vendor/daterangepicker/moment.min.js"></script>
<script src="{{$baseUrl}}vendor/daterangepicker/daterangepicker.js"></script>

<!-- Bootstrap Datepicker Plugin js -->
<script src="{{$baseUrl}}vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap Timepicker Plugin js -->
<script src="{{$baseUrl}}vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Flatpickr Timepicker Plugin js -->
<script src="{{$baseUrl}}vendor/flatpickr/flatpickr.min.js"></script>

<!-- Timepicker Demo js -->
<script src="{{$baseUrl}}js/pages/demo.timepicker.js"></script>

 <!-- Input Mask Plugin js -->
<script src="{{$baseUrl}}vendor/jquery-mask-plugin/jquery.mask.min.js"></script>

<!-- JSZip (for Excel) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- PDFMake (for PDF) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Button extensions for export buttons -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(Session::has('message'))
        showSuccessToast({text: '{{ Session::get("message") }}'});
    @endif

    @if(Session::has('error'))
        showErrorToast({text: '{{ Session::get("error") }}'});
    @endif

    function showSuccessToast(options) {
        $.toast($.extend({
            position: 'top-right',
            loaderBg: 'rgba(0,0,0,0.2)',
            hideAfter: 3000,
            icon: 'success'
        }, options));
    }

    function showErrorToast(options) {
        $.toast($.extend({
            position: 'top-right',
            loaderBg: 'rgba(0,0,0,0.2)',
            hideAfter: 3000,
            icon: 'error'
        }, options));
    }

</script>
