 <!-- add category -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">  
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Address</h5>
                <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body"> 
                <form class="needs-validation" action="{{ action('Website\UserProfileController@editAddress', [$useraddress->id]) }}" method="post" name="edit_model" id="edit_model" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form custom-label-margin">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required="" value="{{$useraddress->name}}" onkeypress="return alphaonly(event)">
                            </div>
                            <div class="col-md-12">
                                <label for="">Mobile No.</label>
                                <input type="text" name="mobile" class="form-control" required="" value="{{$useraddress->mobile}}" maxlength="10" onkeypress="return numbersonly(event)">
                            </div>
                            <div class="col-md-12">
                                <label for="">Pincode</label>
                                <input type="text" name="pincode" class="form-control" required="" value="{{$useraddress->pincode}}" maxlength="6" onkeypress="return numbersonly(event)">
                            </div>
                            <div class="col-md-12">
                                <label for="">State</label>
                                <select class="form-control state" name="state_id">
                                    <option value="">Selecet State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" {{$state->id==$useraddress->state_id?'selected':''}}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">City</label>
                                <select class="form-control city" name="city_id">
                                    <option value="">Select City</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{$city->id==$useraddress->city_id?'selected':''}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">House No / Building Name</label>
                                <input type="text" name="house_no_or_building_name" class="form-control" required="" value="{{$useraddress->house_no_or_building_name}}">
                            </div>
                            <div class="col-md-12">
                                <label for="">Land Mark</label>
                                <input type="text" name="landmark" class="form-control" required="" value="{{$useraddress->landmark}}">
                            </div>
                             <div class="col-md-12">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control" rows="2" required="">{{$useraddress->address}}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Address Type</label>
                                <select class="form-control" name="address_type">
                                    <option value="{{$useraddress->address_type}}">{{$useraddress->address_type}}</option>
                                    <!-- <option value="Office">Office/Work </option> -->
                                </select>
                            </div>
                            <div class="form-group text-right pt-3 pr-3">
                                <button class="btn btn-sm btn-dark" type="submit">Update</button>
                                <button class="btn btn-sm btn-dark waves-effect cancel-model" type="button" data-dismiss="modal">Cancel</button>
                            </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
        <!-- End add model -->

<script type="text/javascript">
      $(document).ready(function()
  {
         $('.state').on('change', function() {         
      var state_id = $(this).val(); 
      if(state_id) {
        $.ajax({
         url: '{{ url("/json-city") }}',
         type: "GET",
         data : {'state_id':state_id,"_token":"{{ csrf_token() }}"},
         dataType: "json",
         success:function(data) {
          if(data){ 
           $('.city').empty();
           $('.city').focus;
           $('.city').append('<option value="">Select City</option>'); 
           $.each(data, function(key, value){                         
           $('.city').append('<option value="'+ value.id +'">' + value.name + '</option>');
          });
          } else {
            $('.city').empty();
          }
         }
        });
      } else {
        $('.city').empty();
      }
  });
     });
</script>