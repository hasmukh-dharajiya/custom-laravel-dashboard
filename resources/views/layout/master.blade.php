<!DOCTYPE html>
<html lang="en">
<head>
  @include('layout.header')

  @yield('style')

</head>
<body>
<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

  <!--**********************************
  Header start
  ***********************************-->
  @include('layout.navbar')
<!--**********************************
  Header End
  ***********************************-->
<!--**********************************
  Sidebar Start
***********************************-->
  @include('layout.sidebar')
<!--**********************************
  Sidebar end
***********************************-->

<!--**********************************
  Content body start
***********************************-->
    <div class="content-body" style="min-height: 788px;">
        @include('layout.alert')
        <div class="container-fluid">
            @yield('contain')
        </div>
    </div>

<!--**********************************
  Content body end
***********************************-->

<!--**********************************
  Footer start
***********************************-->
  @include('layout.footer')
<!--**********************************
  Footer end
***********************************-->
</div>

<!--**********************************
Scripts
***********************************-->
<script src="{{ asset('vendor/global/global.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/apexchart/apexchart.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/peity/jquery.peity.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/chartist/js/chartist.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/svganimation/vivus.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/svganimation/svg.animation.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard/dashboard-4.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js"></script>
<script src="{{ asset('js/custom/toastr.min.js') }}"></script>
@yield('script')

<!--**********************************
End Scripts
***********************************-->

<script>
    function logout() {
        $.ajax({
            type      : 'GET',
            url       : '/logout',
            dataType  : 'json',
            success   : function(res) {
                if(res.status === true){
                    toastr.info(res.message, "Info", toastOption);
                    window.location.href = '/sign-in'
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var obj = JSON.parse(jqXHR.responseText);
                if(obj.status === false){
                    toastr.error(obj.message, "Error", toastOption);
                }
            },
        });
    }

    var toastOption = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "10000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

</script>
	</body>
</html>
