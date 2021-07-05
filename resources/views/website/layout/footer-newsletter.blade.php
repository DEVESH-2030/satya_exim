@php 
    $newsAlert = App\Models\NewsAlert::get();
@endphp 

<style>
    #emailcheck{
                font-size: 15px;
                color: rgb(255, 0, 0);
                position: absolute;
                margin-top: 85px;
                margin-left: 15px;
    }
</style>

<div class="light-layout">
    <div class="container">
        <section class="small-section border-section border-top-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="subscribe">
                        <div>
                            <h4>KNOW IT ALL FIRST!</h4>
                            <p>Never Miss Anything From E-Commerce By Signing Up To Our Newsletter.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"> 
                    <form action="{{route('/newsalert-add')}}" class="form-inline subscribe-form auth-form needs-validation" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" enctype="multipart/data-form">
                        @csrf
                        <div class="form-group mx-sm-3">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Enter your email" required="required" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,5}$">
                                <h5 id="emailcheck"></h5>
                        </div>
                               
                        <button type="submit" class="btn btn-solid" id="submit">subscribe</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="{{url('assets/js/jquery-3.3.1.min.js')}}"></script>
<script>
    
/*---- Query for News Alert ---*/

$(document).on('submit', 'form#mc-embedded-subscribe-form', function(e) { 
     $('#emailcheck').hide();
      e.preventDefault();
      var data = new FormData(this);

      $.ajax({
          cache:false,
          contentType: false,
          processData: false,
          url: $(this).attr("action"),
          method: $(this).attr("method"),
          dataType: "json",
          data: data,
          success: function(response) { 
            if (response.success == 200) {
                $('#emailcheck' ).show();
                $('#emailcheck').html("Thanks for subscribe ");
                $('#emailcheck').focus();
                $('#emailcheck').css("color","green");
                // alert(response.message);
                location.reload();
            } else {
                $('#emailcheck').show();
                $('#emailcheck').html("Sorry, this email already exist !");
                $('#emailcheck').focus();
                $('#emailcheck').css("color","red");
                // alert(response.message);
            }
          }
      }); 
});

/*--- End News Alert query ---*/
</script>

