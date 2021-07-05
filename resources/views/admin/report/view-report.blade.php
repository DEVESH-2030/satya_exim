
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title f-w-600" id="exampleModalLabel">Report Detail</h5>
            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">  {{-- @dd($viewReport) --}}
            <form class="needs-validation" action="{{ action('Admin\ReportController@viewReport',[ $viewReport->id] ?? '') }}" method="post" enctype="multipart/form-data" name="view_model" id="view_model">
                @csrf
                <div class="table-responsive">
                  <table class="table">
                       <tr>
                           <td><b>Customer ID</b></td>
                           <td>{{$viewReport->userDetail->id}}</td>
                       </tr>
                       <tr>
                           <td><b>Customer Name</b></td>
                           <td>{{$viewReport->userDetail->first_name}} {{$viewReport->userDetail->last_name}} </td>
                       </tr>
                       <tr>
                           <td><b>Order ID</b></td>
                           <td>{{$viewReport->order_id}}</td>
                       </tr>
                       <tr>
                           <td><b>Purchased Date</b></td>
                           <td>
                              @php 
                                $purchaseDate = date('Y-m-d', strtotime($viewReport->created_at))
                              @endphp
                              {{ $purchaseDate }}
                            </td>
                       </tr>
                       <tr>
                           <td><b>Order Complete Date</b></td>
                           <td> @php 
                                $purchaseDate = date('Y-m-d', strtotime($viewReport->updated_at))
                              @endphp
                              {{ $purchaseDate }}
                            </td>
                       </tr>
                       <tr>
                           <td><b>Payment Status</b></td>
                           <td>
                        @if($viewReport->status == '1' ??'')
                            <span class="badge badge-danger">In Progress</span>
                            @elseif($viewReport->status == '2' ??'')
                            <span class="badge badge-warning">Pending</span>
                            @elseif($viewReport->status == '3' ??'')
                            <span class="badge badge-success">Delivered</span>
                            @else
                            <span class="badge badge-primary">Cancelled</span>
                        @endif
                    </td>
                       </tr>
                      <!--  <tr>
                           <td><b>Transaction Id</b></td>
                           <td>
                              {{$viewReport->transection_id}}
                            </td>
                       </tr> -->
                       <tr>
                           <td><b>Order Amount</b></td>
                           <td>
                              ₹ {{$viewReport->order_amount}}
                            </td>
                       </tr>
                  </table>
                </div>
            </form>
        </div>
    </div>
</div>
           