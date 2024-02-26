<!-- CoreUI and necessary plugins-->
<script src="{{asset('admin/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('admin/vendors/simplebar/js/simplebar.min.js')}}"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{asset('admin/vendors/chart.js/js/chart.min.js')}}"></script>
<script src="{{asset('admin/vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
<script src="{{asset('admin/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


<script>
     $(document).ready(function() {
        $(".commonDatepicker").datepicker({
            endDate: new Date(),
            changeMonth: true,
            changeYear: true,
            firstDay: 1,
            autoclose:true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            
        });
     });
</script>
@stack('customjs')