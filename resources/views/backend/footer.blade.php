<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('backend/assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('backend/assets/js/jquery-slimscroll/jquery.slimscroll.js') }}">
</script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('backend/assets/js/modernizr/modernizr.js') }}"></script>
<!-- am chart -->
<script src="{{ asset('backend/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/widget/amchart/serial.min.js') }}"></script>
<!-- Todo js -->
<script type="text/javascript " src="{{ asset('backend/assets/pages/todo/todo.js ') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('backend/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/js/script.js') }}"></script>
<script type="text/javascript " src="{{ asset('backend/assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('backend/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/demo-12.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/datatables/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/sweetalert/sweetalert2.min.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example2').DataTable();
    })

</script>







<script>
    var $window = $(window);
    var nav = $('.fixed-button');
    $window.scroll(function() {
        if ($window.scrollTop() >= 200) {
            nav.addClass('active');
        } else {
            nav.removeClass('active');
        }
    });

</script>
</body>

</html>
