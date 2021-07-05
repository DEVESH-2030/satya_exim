
@extends('admin.layout.app')

  @section('content')
    <!-- Container-fluid starts-->
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6"> {{-- @dd($reports) --}}
                <div class="page-header-left">
                    <h3>Report List
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Report Management</li>
                    <li class="breadcrumb-item active">Report List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="container-fluid">
      <div class="card">
        <!-- start Search -->
        <div class="card-header">
            <form class="form-horizontal" action="{{action('Admin\ReportController@repostList')}}" method="get">
                <div class="form-row">

                  <div class="form-group col-md-3">
                    <label for="">Order ID</label>
                    <input type="text" class="form-control" name="order_id" id="order_id" placeholder="Enter Order ID" value="<?php echo $order_id ??''; ?>">
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label for="">Customer Id</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" placeholder="Enter Customer ID" value="<?php echo $user_id ??''; ?>">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="">Customer Name</label>
                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Customer Name" value="<?php echo $user_name ??''; ?>">
                  </div>

                  <!-- <div class="form-group col-md-3">
                    <label for="">Purchased Date</label>
                    <input type="date" class="form-control" name="purchaseDate" id="purchaseDate" placeholder="Enter Purchased Date"  value="">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="">Order Complete Date</label>
                    <input type="date" class="form-control" name="completedDate" id="completedDate" placeholder="Enter Order Complete Date" value="">
                  </div> -->

                  <div class="form-group d-flex align-items-end col-md-3">
                      <button class="btn btn-primary mr-2" type="submit">Search</button>
                      <a href="{{url('admin/reports')}}" class="btn btn-secondary" type="button">Reset</a>
                  </div>
                </div>
            </form>
        </div>
        <!-- end Search -->
        
        <!-- Report list -->
        <div class="card-body order-datatable">
          <table class="display table jsgrid" id="basic-1">
              <thead>
                  <tr>
                      <th>Sr. No.</th>
                      <th>Customer ID</th>
                      <th>Customer Name</th>
                      <th>Order ID</th>
                      <th>Purchased Date</th>
                      <th>Order Complete Date</th>
                      <!-- <th>Status</th> -->
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @php 
                    $serialNo = 1;
                  @endphp
                  @foreach($reports as $reportList)
                  <tr>
                      <td>{{ $serialNo++ }}</td>
                      <td>{{ $reportList->userDetail->id ??'' }}</td>
                      <td>{{ $reportList->userDetail->first_name ??'' }} {{ $reportList->userDetail->last_name ??'' }}</td>
                      <td>{{ $reportList->order_id ??'' }}</td>
                      <td>
                        @php 
                          $purchaseDate = date('Y-m-d', strtotime($reportList->created_at));
                        @endphp
                        {{ $purchaseDate ??'' }}
                      </td>
                      <td>
                        @php 
                          $orderCompletedDate = date('Y-m-d', strtotime($reportList->updated_at));
                        @endphp
                        {{ $orderCompletedDate ??'' }}
                      </td>
                      <!-- <td><span class="text-success">Active</span></td> -->
                      <td>
                        <div class="d-flex">

                           <!-- View Report  -->
                          <button type="button" data-href="{{action('Admin\ReportController@viewReport',[$reportList->id] ?? '') }}" class="fa-icon fa fa-eye mr-2 view_model" data-toggle="modal" data-target="#view_model"></button>
                         
                          <!-- Delete Report -->
                          <button class="jsgrid-button jsgrid-delete-button mr-2" type="button" href="" onclick="deleteReport({{$reportList->id}})" ></button> 
                        </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <!-- end report list -->
      </div>
    </div>
    <!-- Container-fluid Ends-->
   
  @endsection


  <script>
    function deleteReport(id)
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
          url: "{{url('/admin/delete-report')}}",
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