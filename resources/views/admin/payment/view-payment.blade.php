

    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title f-w-600" id="exampleModalLabel">Payment Details</h5>
            <button class="close cancel-model" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form class="needs-validation" action="{{ action('Admin\PaymentManagementController@viewPayment',[ $viewPaymentDetail->id] ?? '') }}" method="post" enctype="multipart/form-data" name="view_model" id="view_model">
                @csrf
                <div class="table-responsive">
                 <table class="table">  
                           <tr>
                               <td><b>Customer ID</b></td>
                               <td>{{$viewPaymentDetail->userDetail->id ?? ''}}</td>
                           </tr>
                           <tr>
                               <td><b>Customer Name</b></td>
                               <td>{{$viewPaymentDetail->userDetail->first_name ?? ''}} {{$viewPaymentDetail->userDetail->first_name ?? ''}}
                               </td>
                           </tr>
                           <tr>
                               <td><b>Email</b></td>
                               <td>{{$viewPaymentDetail->userDetail->email ?? ''}}</td>
                           </tr>
                           <tr>
                               <td><b>Order ID</b></td>
                               <td>{{$viewPaymentDetail->order_id ?? ''}}</td>
                           </tr>
                           <tr>
                               <td><b>Payment Method</b></td>
                               <td>
                                  @if($viewPaymentDetail->payment_status == '1' ??'')
                                    Online
                                    @else
                                    COD
                                  @endif
                               </td>
                           </tr>
                           <tr>
                               <td><b>Payment Mode</b></td>
                               <td>
                                  @if($viewPaymentDetail->payment_status == '1' ??'')
                                    Online
                                    @else
                                    COD
                                  @endif
                               </td>
                           </tr>
                           <tr>
                               <td><b>Payment Status</b></td>
                               <td>
                                  @if($viewPaymentDetail->payment_status == '1' ??'')
                                    <span class="badge badge-success">Completed</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                  @endif
                                </td>
                           </tr>
                          <!--  <tr>
                               <td><b>Status</b></td>
                               <td>Success</td>
                           </tr> -->
                       </table>
                </div>
            </form>
        </div>
    </div>
</div>