<div class="tab-pane fade" id="change-address">
    <div class="row">
        <div class="col-12"> 
            <div class="card dashboard-table mt-0"> 
                <div class="card-body">  
                    <div class="top-sec">
                        
                       <h3>Address</h3>
                        <button data-href="{{ action('Website\UserProfileController@create') }}" class="btn btn-sm btn-dark add_address_modal">Add Address
                        </button>   
                    </div>
                    <div class="table-responsive">
                    <table class="table table-responsive-sm mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Pincode</th>
                                <th scope="col">State</th>
                                <th scope="col">City</th>
                                <th scope="col">House No / Building Name</th>
                                <th scope="col">Land Mark</th>
                                <th scope="col">Address Type</th>
                                <th scope="col" style="min-width: 90px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $sr = 1; 
                            @endphp
                            @foreach($userAddress as $address)
                            <tr>
                                <th scope="row">{{ $sr++ }}</th>
                                <td>{{ $address->name ??'' }}</td>
                                <td>{{ $address->mobile ??'' }}</td>
                                <td>{{ $address->pincode ??'' }}</td>
                                <td>{{ $address->state->name ??'' }}</td>
                                <td>{{ $address->city->name ??'' }}</td>
                                <td>{{ $address->house_no_or_building_name ??'' }}</td>
                                <td>{{ $address->landmark ??'' }}</td>
                                <td>{{ $address->address_type ??'' }}</td>
                                <td>
                                    <div>
                                         <!-- use edit  -->
                                         <button href="#" data-href="{{ action('Website\UserProfileController@update', [$address->id]) }}" class="btn btn-sm btn-dark edit_model"  data-toggle="modal" data-target="edit_model" data-container=".edit_model">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>   
                                         <!-- <a href="{{ action('Website\UserProfileController@update', [$address->id]) }}"  class="btn btn-sm btn-dark"><i class="fa fa-pencil-square-o"></i> -->
                                        <!-- </a> -->
                                          <!-- <a href="#" data-toggle="modal" data-target="#edit-address" class="btn btn-sm btn-dark"> -->
                                         <button type="button" href="" onclick="deleteAddress({{$address->id}})" class="btn btn-sm btn-dark" ><i class="fa fa-trash-o"></i></button>    
                                       <!--  <a href="#"  class="btn btn-sm btn-dark">
                                            <i class="fa fa-trash-o"></i>
                                        </a> -->
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

<script>
    function deleteAddress(id)
    { 
      
    
      swal({
      title: "Are you sure",
      text: "You want to Delete ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Deleted successfully...", {
          title: "Good Job!",
          icon: "success",
        });

        var token='{{csrf_token()}}';
        var gallery_id = id;
        $.ajax({
          url: "{{url('/delete-address')}}",
          method: "POST",
          dataType: "json",
          data:{'id':id, '_token':token},
          success: function(response) {
            if(response.status == 200){
              // alert('Data deleted successfully !');
              setTimeout(function () { location.reload(1); }, 2000);
            }
          }
        }); 


      } else {
        // swal("Your imaginary file is safe!");
      }
    }); 


    }

</script>