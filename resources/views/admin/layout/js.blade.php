<!-- latest jquery-->
<script src="{{url('admin/assets/js/jquery-3.3.1.min.js')}}"></script>

<!-- ckeditor js-->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
    CKEDITOR.replace( 'editor3' );
</script>
<!-- <script src="{{url('admin/assets/js/editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('admin/assets/js/editor/ckeditor/styles.js')}}"></script>
<script src="{{url('admin/assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
<script src="{{url('admin/assets/js/editor/ckeditor/ckeditor.custom.js')}}"></script>


<script>
	// Default ckeditor
CKEDITOR.replace( 'editor1', {
    on: {
        contentDom: function( evt ) {
            // Allow custom context menu only with table elemnts.
            evt.editor.editable().on( 'contextmenu', function( contextEvent ) {
                var path = evt.editor.elementPath();

                if ( !path.contains( 'table' ) ) {
                    contextEvent.cancel();
                }
            }, null, null, 5 );
        }
    }
} );

</script> -->


<!-- Bootstrap js-->
<script src="{{url('admin/assets/js/popper.min.js')}}"></script>
<script src="{{url('admin/assets/js/bootstrap.js')}}"></script>

<!-- feather icon js-->
<script src="{{url('admin/assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{url('admin/assets/js/icons/feather-icon/feather-icon.js')}}"></script>

<!-- Sidebar jquery-->
<script src="{{url('admin/assets/js/sidebar-menu.js')}}"></script>

<!--chartist js-->
<script src="{{url('admin/assets/js/chart/chartist/chartist.js')}}"></script>

<!--chartjs js-->
<script src="{{url('admin/assets/js/chart/chartjs/chart.min.js')}}"></script>

<!-- lazyload js-->
<script src="{{url('admin/assets/js/lazysizes.min.js')}}"></script>

<!--copycode js-->
<script src="{{url('admin/assets/js/prism/prism.min.js')}}"></script>
<script src="{{url('admin/assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{url('admin/assets/js/custom-card/custom-card.js')}}"></script>

<!--counter js-->
<script src="{{url('admin/assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{url('admin/assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{url('admin/assets/js/counter/counter-custom.js')}}"></script>

<!--peity chart js-->
<script src="{{url('admin/assets/js/chart/peity-chart/peity.jquery.js')}}"></script>

<!--sparkline chart js-->
<script src="{{url('admin/assets/js/chart/sparkline/sparkline.js')}}"></script>

<!--Customizer admin-->
<script src="{{url('admin/assets/js/admin-customizer.js')}}"></script>

<!--dashboard custom js-->
<script src="{{url('admin/assets/js/dashboard/default.js')}}"></script>

<!--right sidebar js-->
<script src="{{url('admin/assets/js/chat-menu.js')}}"></script>

<!--height equal js-->
<script src="{{url('admin/assets/js/height-equal.js')}}"></script>

<!-- lazyload js-->
<script src="{{url('admin/assets/js/lazysizes.min.js')}}"></script>

<!--script admin-->
<script src="{{url('admin/assets/js/admin-script.js')}}"></script>

<!-- touchspin js-->
<script src="{{url('admin/assets/js/touchspin/vendors.min.js')}}"></script>
<script src="{{url('admin/assets/js/touchspin/touchspin.js')}}"></script>
<script src="{{url('admin/assets/js/touchspin/input-groups.min.js')}}"></script>

<!-- form validation js-->
<script src="{{url('admin/assets/js/dashboard/form-validation-custom.js')}}"></script>

<!-- Zoom js-->
<script src="{{url('admin/assets/js/jquery.elevatezoom.js')}}"></script>
<script src="{{url('admin/assets/js/zoom-scripts.js')}}"></script>

<!--dropzone js-->
<!-- <script src="{{url('admin/assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{url('admin/assets/js/dropzone/dropzone-script.js')}}"></script> -->

<!-- Rating Js-->
<script src="{{url('admin/assets/js/rating/jquery.barrating.js')}}"></script>
<script src="{{url('admin/assets/js/rating/rating-script.js')}}"></script>

<!-- Owlcarousel js-->
<script src="{{url('admin/assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{url('admin/assets/js/dashboard/product-carousel.js')}}"></script>

<!-- Datatable js-->
<script src="{{url('admin/assets/js/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/assets/js/datatables/custom-basic.js')}}"></script>
<script src="{{url('admin/assets/js/modal.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- 
<script>
    $('#daterange').daterangepicker({
        opens:'right'
    });
</script> -->
<script>
  $(function() {

  $('#daterange').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('#daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
<script>
    $(function () {
      // Basic instantiation:
      $('#demo-input').colorpicker();
    });
  </script>

  <script>
     $(function () {
      var color =  $("#getFile").val();
        $("#getFile").change(function(){
          $("#color-box").css('background', $(this).val());
          $("#color-value").val($(this).val());  
        });

    });
  </script>

<!-----------------  Custom js paths--------------------------------->  
      <script src="{{ asset('custom/js/validations.js') }}"></script>
      {{-- <script src="{{ asset('custom/js/modal.js') }}"></script> --}}
      <script src="{{ asset('custom/js/image_preview.js') }}"></script>
      <script src="{{ asset('custom/js/active_deactive.js') }}"></script>
      <script src="{{ asset('custom/js/csrf.js') }}"></script>
      <script src="{{ asset('custom/js/toastr.min.js') }}"></script>
      <script src="{{ asset('custom/js/sweetalert.min.js') }}"></script>
  <!--     <script src="{{ asset('custom/js/bootstrap-colorpicker.min.js') }}"></script> -->




<!-- <script>
$(function() {
// Multiple images preview in browser
var imagesPreview = function(input, placeToInsertImagePreview) {

if (input.files) {
var filesAmount = input.files.length;

for (i = 0; i < filesAmount; i++) {
var reader = new FileReader();

reader.onload = function(event) {
$($.parseHTML('<img style="width:80px;height:80px;" class="mr-3 mt-3">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
}

reader.readAsDataURL(input.files[i]);
}
}

};

$('#getimage').on('change', function() {
imagesPreview(this, 'div.gallery');
});
});
</script>   --> 

<script>
  $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#getimage").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">x</span>" +
            "</span>").appendTo("div.gallery");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>

<script type="text/javascript">
$(document).on('click','.cancel-model',function(e){
$('.modal-backdrop').remove();});
</script>

<!-- validation -->
<script>
  
 /************Numbers only *************/

    function numbersonly(e) {
 var k = event ? event.which : window.event.keyCode;
            if (k == 32) return false;
                var unicode=e.charCode? e.charCode : e.keyCode;

                if (unicode!=8) { //if the key isn't the backspace key (which we should allow)
                    if (unicode<48||unicode>57) //if not a number
                    return false //disable key press
                }
            }

 /************Alphabet only *************/
        function alphaonly(evt) {
          var keyCode = (evt.which) ? evt.which : evt.keyCode
          if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
          return false;  
        }  


</script>

<script>
  function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

function getSelectionStart(o) {
  if (o.createTextRange) {
    var r = document.selection.createRange().duplicate()
    r.moveEnd('character', o.value.length)
    if (r.text == '') return o.value.length
    return o.value.lastIndexOf(r.text)
  } else return o.selectionStart
}

// <!-- Image Validation -->

    function imgValidation(evt) { 
        var fileInput =  document.getElementById("file"); 
          
        var filePath = fileInput.value; 
      
        // Allowing file type 
        var allowedExtensions = /(\.png|\.jpeg|\.jpg)$/i; 
          
        if (!allowedExtensions.exec(filePath)) { 
            alert('Invalid file type, please select file type of .png, .jpeg and .jpg'); 
            fileInput.value = ''; 
            return false; 
        }  
        if(fileInput.files[0].size > 2097152){
           alert("File is too big!");
           fileInput.value = "";
        };
    } 

    function imgValidation1(evt) { 
        var fileInput =  document.getElementById("file1"); 
          
        var filePath = fileInput.value; 
      
        // Allowing file type 
        var allowedExtensions = /(\.png|\.jpeg|\.jpg)$/i; 
          
        if (!allowedExtensions.exec(filePath)) { 
            alert('Invalid file type, please select file type of .png, .jpeg and .jpg'); 
            fileInput.value = ''; 
            return false; 
        }  
        if(fileInput.files[0].size > 2097152){
           alert("File is too big!");
           fileInput.value = "";
        };
    } 
</script>
