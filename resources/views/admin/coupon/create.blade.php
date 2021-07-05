 <!-- add coupon  -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Coupon</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="{{ action('Admin\CouponController@store') }}" method="post" name="add_model" id="add_model" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form">
                        <div class="form-group">
                            <label for="validationCustom01" class="mb-1">Coupon Title</label>
                            <input type="text" class="form-control" name="title" value="">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Coupon Code</label>
                            <input type="text" class="form-control" name="coupon_code" value="">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Discount Value</label>
                            <input type="text" class="form-control" name="discount_amount" value="">
                        </div>  
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Start Date</label>
                            <input type="date" class="form-control" id="datefield1" name="start_date" value="">
                        </div>
                        <div class="form-group">
                            <label for="validationCustom02" class="mb-1">End Date</label>
                            <input type="date" class="form-control" id="datefield2" name="end_date" value="">
                        </div>
                       {{--  <div class="form-group">
                            <label for="validationCustom02" class="mb-1">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Active</option>
                                <option value="">Inactive</option>
                            </select>
                        </div> --}}
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-outline-primary cancel-model" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- end add coupon -->
        

<script>
   var input = document.getElementById("datefield1");
      var today = new Date();
      var day = today.getDate();
      // Set month to string to add leading 0
      var mon = new String(today.getMonth()+1); //January is 0!
      var yr = today.getFullYear();
      
        if(mon.length < 2) { mon = "0" + mon; }
      
        var date = new String( yr + '-' + mon + '-' + day );
      
      input.disabled = false; 
      input.setAttribute('min', date);
</script>

<script>
   var input = document.getElementById("datefield2");
      var today = new Date();
      var day = today.getDate();
      // Set month to string to add leading 0
      var mon = new String(today.getMonth()+1); //January is 0!
      var yr = today.getFullYear();
      
        if(mon.length < 2) { mon = "0" + mon; }
      
        var date = new String( yr + '-' + mon + '-' + day );
      
      input.disabled = false; 
      input.setAttribute('min', date);
</script>