<!-- latest jquery-->
    <script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>

    <!-- fly cart ui jquery-->
    <script src="{{url('assets/js/jquery-ui.min.js')}}"></script>

    <!-- exitintent jquery-->
    <script src="{{url('assets/js/jquery.exitintent.js')}}"></script>
    <script src="{{url('assets/js/exit.js')}}"></script>

    <!-- popper js-->
    <script src="{{url('assets/js/popper.min.js')}}"></script>

    <!-- slick js-->
    <script src="{{url('assets/js/slick.js')}}"></script>

    <!-- menu js-->
    <script src="{{url('assets/js/menu.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{url('assets/js/lazysizes.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{url('assets/js/bootstrap.js')}}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{url('assets/js/bootstrap-notify.min.js')}}"></script>

    <!-- Fly cart js-->
    <!-- <script src="{{url('assets/js/fly-cart.js')}}"></script> -->

    <!-- Theme js-->
    <script src="{{url('assets/js/script.js')}}"></script>
    <script src="{{url('assets/js/range-slider.js')}}"></script>
    <script src="{{url('assets/js/csrf.js')}}"></script>
<script type="text/javascript">
    function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
</script>

<script type="text/javascript">
    $(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
        case 's':
            event.preventDefault();
            break;
        case 'f':
            event.preventDefault();
            break;
        case 'g':
            event.preventDefault();
            break;
        }
    }
})
</script>

<script type="text/javascript">
    jQuery(function($)
     {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('#main-nav ul li a').each(function() {
      if (this.href === path) {
        $('#main-nav').find('li').removeClass('active');
        $(this).parents('li').addClass('active');

      }
     });
    });
</script>


<!-----------------  Custom js paths--------------------------------->  
      <script src="{{ asset('custom/js/validations.js') }}"></script>
      <script src="{{ asset('custom/js/modal.js') }}"></script> 
      <script src="{{ asset('custom/js/image_preview.js') }}"></script>
      <script src="{{ asset('custom/js/active_deactive.js') }}"></script> 
      <script src="{{ asset('custom/js/toastr.min.js') }}"></script>  
      <script src="{{ asset('custom/js/sweetalert.min.js') }}"></script>
  <!--     <script src="{{ asset('custom/js/bootstrap-colorpicker.min.js') }}"></script> -->
  